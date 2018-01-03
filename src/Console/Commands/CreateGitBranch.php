<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CreateGitBranch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gitbranch:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new GIT branch';

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
        $brType = $this->choice('What type of branch you would like to create?',['masterfix','developfix']);
        $brURL=$this->ask("Input the link to the task in JIRA");
        $brName = substr(strrchr($brURL,'/'),1);
        $brDescription =$this->ask("Please write a short description");
        if(!preg_match("/\b[A-Z]{1,4}\b[-]\b[0-9]{1,5}\b/",$brName)){
            if($this->confirm('Are you sure you want to create branch "'.$brType."/".$brName."/".$brDescription.'"?')){
                $this->line(shell_exec('git checkout -b "'.$brType."/".$brName.'"'));
            }
        }else{
            $this->line(shell_exec('git checkout -b "'.$brType."/".$brName."/".$brDescription.'"'));
        }
    }
}
