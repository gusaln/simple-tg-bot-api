<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in(__DIR__.DIRECTORY_SEPARATOR.'src')
    ->in(__DIR__.DIRECTORY_SEPARATOR.'tools')
    ->in(__DIR__.DIRECTORY_SEPARATOR.'scripts')
    ->in(__DIR__.DIRECTORY_SEPARATOR.'examples')
    ->notPath([
        "/MethodRequests/",
        "/Types/",
    ])
    // ->in(__DIR__.DIRECTORY_SEPARATOR.'tests')
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true)
;

return (new Config())
    ->setCacheFile(__DIR__.DIRECTORY_SEPARATOR.'php-cs.cache')
    ->setRiskyAllowed(true)
    ->setRules([
        '@PHP74Migration' => true,
        '@PHP80Migration' => true,
        '@PHP81Migration' => true,
        '@PSR2' => true,
        '@Symfony' => true,
        'align_multiline_comment' => ['comment_type' => 'all_multiline'],
        'array_indentation' => true,
        'array_push' => true,
        'array_syntax' => ['syntax' => 'short'],
        'combine_consecutive_issets' => true,
        'declare_strict_types' => true,
        'explicit_indirect_variable' => true,
        'explicit_string_variable' => true,
        'list_syntax' => ['syntax' => 'short'],
        'method_argument_space' => ['on_multiline' => 'ensure_fully_multiline'],
        'method_chaining_indentation' => true,
        'modernize_types_casting' => true,
        'no_unreachable_default_argument_value' => true,
        'not_operator_with_successor_space' => true,
        'operator_linebreak' => true,
        'ordered_interfaces' => true,
        'ordered_traits' => true,
        'php_unit_method_casing' => ['case' => 'snake_case'],
        'php_unit_size_class' => ['group' => 'medium'],
        'php_unit_test_annotation' => ['style' => 'annotation'],
        'phpdoc_add_missing_param_annotation' => true,
        'phpdoc_annotation_without_dot' => true,
        'phpdoc_no_alias_tag' => ['replacements' => ['type' => 'var', 'link' => 'see']],
        'phpdoc_no_empty_return' => true,
        'phpdoc_order' => true,
        'return_assignment' => true,
        'simple_to_complex_string_variable' => true,
        'simplified_if_return' => true,
        'trailing_comma_in_multiline' => true,
        'types_spaces' => ['space' => 'none'],
        'void_return' => false,
    ])
    ->setFinder($finder)
;
