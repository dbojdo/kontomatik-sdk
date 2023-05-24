<?php

namespace Goosfraba\Kontomatik\Importing;

final class DefaultImportCommand extends AbstractCommand
{
    public function __construct(
        Command $command
    ) {
        parent::__construct(
            $command->getId(),
            $command->getState(),
            $command->getName(),
            $command->getTarget(),
            $command->getInstitution(),
            $command->getProgress(),
            $command->getResult(),
            $this->getException()
        );
    }

    public function getTargetResult(): ?Target
    {
        return $this->getResult();
    }
}