<?php

class FormField{
    public function __construct(
        protected string $label,
        protected string $name,
        protected string $type = "text",
        protected string $value = ""
    ){}

    public function setValue(string $value): void{
        $this->value = $value;
    }

    public function getValue(): string{
        return $this->value;
    }

    public function getName(): string{
        return $this->name;
    }

    public function render() : string{
        return "<label for=\"{$this->name}\"> {$this->label} </label> 
        <input type=\"{$this->type}\" name=\"{$this->name}\" id=\"{$this->name}\" value=\"{$this->value}\"/>";
    }

    public function __toString(): string{
        return $this->render();
    }
}

class Form{

    /**
     * $var array<string, FormField>
     */
    private array $fieldList = [];

    public function __construct(
        private string $method = "post",
        private string $action = "",
    ){}

    public function addField(FormField $value): self{
        $this->fieldList[$value->getName()] = $value;
        return $this;
    }

    private function renderFields(){
        $rendered = array_map(
            fn ($item) => $item->render(),
            $this->fieldList
        );
        return implode("<br>", $rendered);
    }
    public function render(): string{
        return "<form method=\"{$this->method}\" action=_\"{$this->action}\">
            {$this->renderFields()}
        </form>" ;
    }

    public function hydrate(array $data): void{
        foreach($data as $key => $value){
            if(array_key_exists($key, $this->fieldList)){
                $this->fieldList[$key]->setValue($value);
            }
        }
    }

    public function __toString(): string{
        return $this->render();
    }
}
