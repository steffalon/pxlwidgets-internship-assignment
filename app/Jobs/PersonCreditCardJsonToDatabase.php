<?php

namespace App\Jobs;

use App\Models\CreditCard;
use App\Models\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PersonCreditCardJsonToDatabase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var UploadedFile
     */
    private $uploadedFile;

    /**
     * Create a new job instance.
     *
     * @param UploadedFile $uploadedFile
     * @throws FileNotFoundException
     */
    public function __construct(UploadedFile $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile->get();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $json = json_decode($this->uploadedFile);

            foreach ($json as $item) {

                $age = 0;

                if (isset($item->date_of_birth)) {
                    // https://stackoverflow.com/a/24443152 translate date to compatible MySQL datetime type.
                    $birthday = date('Y-m-d H:i:s.uZ', strtotime($item->date_of_birth));
                    $age = date_diff(date_create($birthday), date_create('now'))->y;
                }

                // Allow only ages between 18-65 or if the person age is unknown.
                if ($age >= 18 && $age <= 65 || !isset($birthday)) {
                    $person = new Person;
                    $creditCard = new CreditCard();

                    $person->name = $item->name;
                    $person->address = $item->address;
                    $person->checked = $item->checked;
                    $person->description = $item->description;
                    $person->interest = $item->interest;
                    if (isset($birthday)) {
                        $person->date_of_birth = $birthday;
                    }
                    $person->email = $item->email;
                    $person->account = $item->account;

                    $creditCard->type = $item->credit_card->type;
                    $creditCard->number = $item->credit_card->number;
                    $creditCard->name = $item->credit_card->name;

                    // "m/y" exp converting to date
                    $credit_exp = explode('/', $item->credit_card->expirationDate);
                    $creditCard->expiration_date = date('Y-m-d',
                        mktime(0,0,0,$credit_exp[0],1,
                            // Year from 2 digit to full
                            date_create_from_format('y', $credit_exp[1])->format('Y')
                        )
                    );

                    $person->save();
                    $person->creditCard()->save($creditCard);
                }
            }
        } catch (FileNotFoundException $e) {
            logger()->error($e);
        }
        logger("Job finished");
    }
}
