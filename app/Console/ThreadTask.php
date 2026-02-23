<?php
namespace App\Console;

class ThreadTask {
// class ThreadTask extends \Thread {
    private $callback_task;
    private $callback_data;

    public function __construct($data, $task){
        $this->callback_data = $data;
        $this->callback_task = $task;
    }

    public function run() {
        if(is_callable($this->callback_task)){
            call_user_func($this->callback_task, $this->callback_data);
        }
    }

    public function start(){
        $this->run();
    }
}