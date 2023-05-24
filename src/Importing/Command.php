<?php

namespace Goosfraba\Kontomatik\Importing;

final class Command extends AbstractCommand
{
    private const STATE_SETUP = "setup";
    private const STATE_IN_PROGRESS = "in_progress";
    private const STATE_SUCCESSFUL = "successful";
    private const STATE_ERROR = "error";
    private const STATE_FATAL = "fatal";

    /**
     * @param mixed $result
     * @return self
     * @internal To be used be the serializer
     */
    public function withResult(mixed $result): self
    {
        return new self(
            $this->getId(),
            $this->getState(),
            $this->getName(),
            $this->getTarget(),
            $this->getInstitution(),
            $this->getProgress(),
            $result,
            $this->getException()
        );
    }

    /**
     * @inheritDoc
     */
    public function getResult(): mixed
    {
        return parent::getResult();
    }

    /**
     * Cast to DefaultImportCommand
     *
     * @return DefaultImportCommand
     */
    public function asDefaultImportCommand(): DefaultImportCommand
    {
        return new DefaultImportCommand($this);
    }

    /**
     * Checks if the command is finished
     *
     * @return bool
     */
    public function isFinished(): bool
    {
        return in_array($this->getState(), [self::STATE_SUCCESSFUL, self::STATE_ERROR, self::STATE_FATAL]);
    }

    /**
     * Checks if the command is finished successfully
     *
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return $this->getState() === self::STATE_SUCCESSFUL;
    }

    /**
     * Checks if the command is running
     *
     * @return bool
     */
    public function isRunning(): bool
    {
        return $this->getState() === self::STATE_IN_PROGRESS;
    }

    /**
     * Checks if the command is in "setup" state
     *
     * @return bool
     */
    public function isSetup(): bool
    {
        return $this->getState() === self::STATE_SETUP;
    }
}
