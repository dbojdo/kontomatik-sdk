<?php

namespace Goosfraba\Kontomatik\Lending;

use JMS\Serializer\Annotation as JMS;

final class OwnerScores
{
    public function __construct(
        /**
         * @var Model[]
         */
        #[JMS\XmlList(entry: "model", inline: true)]
        #[JMS\Type("array<Goosfraba\Kontomatik\Lending\Model>")]
        private ?array $models = []
    ) {
    }

    /**
     * Gets all the models
     *
     * @return array
     */
    public function getModels(): array
    {
        return $this->models ?? [];
    }

    /**
     * Gets the model of given ID
     *
     * @param string $id
     * @return Model|null
     */
    public function getModel(string $id): ?Model
    {
        foreach ($this->getModels() as $model) {
            if ($model->getId() === $id) {
                return $model;
            }
        }

        return null;
    }

    /**
     * Gets the available model IDs
     *
     * @return string[]
     */
    public function getModelIds(): array
    {
        return array_map(fn(Model $model) => $model->getId(), $this->getModels());
    }
}