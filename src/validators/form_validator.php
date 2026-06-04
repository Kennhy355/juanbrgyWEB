<?php
/**
 * Form Validator
 * 
 * Simple validation functions for form inputs.
 */

/**
 * Validate that required fields are present and not empty.
 *
 * @param array $data    The input data (e.g., $_POST).
 * @param array $fields  List of required field names.
 * @return array         Array of error messages (empty if valid).
 */
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

/**
 * Validate an email address.
 */
function validate_email(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate minimum string length.
 */
function validate_min_length(string $value, int $min): bool
{
    return mb_strlen(trim($value)) >= $min;
}

/**
 * Validate maximum string length.
 */
function validate_max_length(string $value, int $max): bool
{
    return mb_strlen(trim($value)) <= $max;
}
