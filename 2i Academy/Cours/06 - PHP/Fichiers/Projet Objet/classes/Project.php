<?php

class Task {

    public function __construct(
        private string $name,
        public bool $done
    )
    {}
}

class Project {

    public function __construct(
        private string $name,
        private array $taskList = []
    ){}

    public function getName(): string{
        return $this->name;
    }

    public function getPercentCompleted($taskList): int{
        $completed = array_filter($this->taskList, fn ($item) => $item->done);
        return count($completed) / count($this->taskList) * 100;
    }

    public function addTask(Task $task): self{
        // Equivalent à array_push mais plus performant
        $this->taskList[] = $task;
        return $this;
    }

}