<?php

namespace Neutron\Quiz\Model;

return [
    'quiz_category' => [
        'table_factory',
        ':quiz_category',
        QuizCategory::class,
        'package/quiz/config/model/quiz_category.php',
    ],
];