<?php

namespace App\Infrastructure\Console\Commands;

use App\Domain\User\Models\User;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $user = new User([
                'name'  => $this->argument('name'),
                'email' => $this->argument('email'),
                'password' => bcrypt($this->argument('password'))
            ]);
    
            if($user->save()) {
                $token = $user->createToken('Personal Access Token');
                $this->info("Successfully created user! Token: {$token->plainTextToken}");
            } else {
                $this->error("User was not created!");
            }
        } catch (\Exception $e) {
            $this->error("An error occurred: {$e->getMessage()}");
        }
    }
}
