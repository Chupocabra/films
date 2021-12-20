<?php

namespace App\Validator;
use Symfony\Component;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class MyValidator
{
    public function getConstraints(): Assert\Collection
    {

        return new Assert\Collection([
            'title' => [
                new Assert\NotBlank(['message' => 'Укажите название фильма'])
            ],
            'rew' => [
                new Assert\NotBlank(['message' => 'Обзор должен содержать текст']),
            ],
            'poster' => new Assert\File([
                'maxSize' => '12M',
                'maxSizeMessage' => '{{ name }} Максимальный размер файла - {{ limit }} {{ suffix }}',
                'mimeTypes' => [
                    'image/jpeg',
                    'image/png',
                ],
                'mimeTypesMessage' => "{{ name }} Неверный тип файла {{ type }}."
            ])
        ]);
    }

    public function validate(array $data): array
    {
        $validator = Validation::createValidator();
        $constraints = $this->getConstraints();
        $violations = $validator->validate();
        $errors = [];       
        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                $errors[] = $violation->getMessage();
            }
        }
        return $errors;
    }
}