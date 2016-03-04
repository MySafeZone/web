<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Bag;
use Mail;

class CheckEnd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the death';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $periodicities_time = array(
                '1' => 60*60*6,
                '2' => 60*60*12,
                '3' => 60*60*24,
                '4' => 60*60*72,
                '5' => 60*60*24*7,
                '6' => 60*60*24*15
        );

        $bags_3 = Bag::whereNotNull('second_reminder_at')->whereNull('send_at')->get();
        foreach ($bags_3 as $bag_3)
        {
            if ((strtotime($bag_3->end_at) + ($periodicities_time[$bag_3->periodicity]*2) ) < time()) {
                // Unleash the kraken
                $bag_3->send();
                $bag_3->send_at = date('Y-m-d H:i:s');
                $bag_3->save();
            }
        }

        $bags_2 = Bag::whereNotNull('first_reminder_at')->whereNull('second_reminder_at')->whereNull('send_at')->get();
        foreach ($bags_2 as $bag_2)
        {

            if ((strtotime($bag_2->end_at) + $periodicities_time[$bag_2->periodicity]) < time()) {
                // Send second mail

                Mail::send(
                    ['text' => 'emails.reminders.second'], ['bag' => $bag_2], function ($m) use ($bag_2) {
                        $m->from('admin@leter.io', 'Leter.io');
                        $m->bcc('admin@leter.io', 'Leter.io');
                        $m->to($bag_2->user->email)->subject('Leter.io > Second reminder');
                    }
                );

                $bag_2->second_reminder_at = date('Y-m-d H:i:s');
                $bag_2->save();
            }
        }

        $bags_1 = Bag::where('end_at', '<', date('Y-m-d H:i:s'))->whereNull('first_reminder_at')->whereNull('send_at')->get();
        foreach ($bags_1 as $bag_1)
        {
            // Send First mail
            Mail::send(
                ['text' => 'emails.reminders.first'],  ['bag' => $bag_1], function ($m) use ($bag_1) {
                    $m->from('admin@leter.io', 'Leter.io');
                    $m->bcc('admin@leter.io', 'Leter.io');
                    $m->to($bag_1->user->email)->subject('Leter.io > First reminder');
                }
            );

            $bag_1->first_reminder_at = date('Y-m-d H:i:s');
            $bag_1->save();
        }
    }
}
