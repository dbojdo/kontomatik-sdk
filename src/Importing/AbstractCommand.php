<?php

namespace Goosfraba\Kontomatik\Importing;

use Goosfraba\Kontomatik\Exception;
use JMS\Serializer\Annotation as JMS;

abstract class AbstractCommand
{
    public function __construct(
        #[JMS\XmlAttribute]
        private ?string $id = null,

        #[JMS\XmlAttribute]
        private ?string $state = null,

        #[JMS\XmlAttribute]
        private ?string $name = null,

        #[JMS\XmlAttribute]
        private ?string $target= null,

        #[JMS\XmlAttribute]
        private ?string $institution = null,

        #[JMS\XmlElement]
        private ?CommandProgress $progress = null,

        #[JMS\Exclude]
        private mixed $result = null,

        #[JMS\XmlElement]
        private ?Exception $exception = null
    ) {
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getTarget(): ?string
    {
        return $this->target;
    }

    /**
     * @return string|null
     */
    public function getInstitution(): ?string
    {
        return $this->institution;
    }

    /**
     * @return CommandProgress|null
     */
    public function getProgress(): ?CommandProgress
    {
        return $this->progress;
    }

    /**
     * @return mixed
     */
    protected function getResult(): mixed
    {
        return $this->result;
    }

    /**
     * @return Exception|null
     */
    public function getException(): ?Exception
    {
        return $this->exception;
    }

    /**
     * Checks if the result of the command is of given class
     *
     * @param string $class
     * @return void
     */
    protected function assertResultType(string $class): void
    {
        if ($this->result === null || $this->result instanceof $class) {
            return;
        }

        throw new \InvalidArgumentException(
            sprintf("Result must be an instance of \"%s\"", $class)
        );
    }
}