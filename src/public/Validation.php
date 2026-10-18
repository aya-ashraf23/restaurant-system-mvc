<?php
namespace Aslam\Test\public;

class Validation
{
    private const NAME_PATTERN = "/^[\\p{L}\\p{M}]+(?:[ '\\-][\\p{L}\\p{M}]+)*$/u";
    private const MIDDLE_NAME_PATTERN = "/^(?=.*\\p{L})[\\p{L}\\p{M}.]+(?:[ '\\-][\\p{L}\\p{M}.]+)*$/u";
    private const USERNAME_PATTERN = '/^[\p{L}\p{N}_-]{3,30}$/u';

    public function validate(array $inputData, array $requiredFields): array
    {
        return $this->validateInputs($inputData, $requiredFields, true);
    }

    public function validateLogin(array $credentials): array
    {
        return $this->validateInputs($credentials, ['username', 'password'], false);
    }

    private function validateInputs(array $inputData, array $requiredFields, bool $enforcePasswordPolicy): array
    {
        $errors = [];

        foreach ($inputData as $field => $value) {
            if (!is_string($value)) {
                $errors[$field] = ucfirst($field) . ' must be a string.';
                continue;
            }

            if ($field !== 'password') {
                $value = trim($value);
            }

            if (in_array($field, $requiredFields, true) && $value === '') {
                $errors[$field] = ucfirst($field) . ' is required.';
                continue;
            }

            if ($value === '') {
                continue;
            }

            if ($field === 'middlename' && preg_match(self::MIDDLE_NAME_PATTERN, $value) !== 1) {
                $errors[$field] = 'Middlename must contain at least one letter and may also contain spaces, apostrophes, hyphens, and dots.';
            } elseif (in_array($field, ['firstname', 'lastname'], true)
                && preg_match(self::NAME_PATTERN, $value) !== 1) {
                $errors[$field] = ucfirst($field) . ' may contain only letters, spaces, apostrophes, and hyphens.';
            } elseif ($field === 'username' && preg_match(self::USERNAME_PATTERN, $value) !== 1) {
                $errors[$field] = 'Username must be 3-30 characters and contain only letters, numbers, underscores, or hyphens.';
            } elseif ($field === 'password') {
                if (strlen($value) > 72) {
                    $errors[$field] = 'Password must not exceed 72 bytes.';
                } elseif (preg_match('/[\p{Extended_Pictographic}\x{1F1E6}-\x{1F1FF}\x{FE0F}\x{20E3}]/u', $value) === 1) {
                    $errors[$field] = 'Emojis are not allowed in passwords.';
                } elseif ($enforcePasswordPolicy && (
                    strlen($value) < 8
                    || preg_match('/[a-z]/', $value) !== 1
                    || preg_match('/[A-Z]/', $value) !== 1
                    || preg_match('/[0-9]/', $value) !== 1
                    || preg_match('/[^a-zA-Z0-9]/', $value) !== 1
                )) {
                    $errors[$field] = 'Password must be 8-72 bytes and include a lowercase, an uppercase, a number, and a symbol.';
                }
            }
        }

        foreach ($requiredFields as $field) {
            if (!array_key_exists($field, $inputData)) {
                $errors[$field] = ucfirst($field) . ' is required.';
            }
        }

        return $errors;
    }
}
