<?php



function validate_required(array $data, array $fields): array
{
    $errors = [];
    foreach ($fields as $field) {
        if (!isset($data[$field]) || trim($data[$field]) === '') {
            $errors[$field] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
        }
    }
    return $errors;
}


function validate_email(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}


function validate_min_length(string $value, int $min): bool
{
    return mb_strlen(trim($value)) >= $min;
}


function validate_max_length(string $value, int $max): bool
{
    return mb_strlen(trim($value)) <= $max;
}
