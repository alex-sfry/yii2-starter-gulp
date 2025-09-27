module.exports = {
    content: [
        '../views/**/*.php',
        // '../vendor/yiisoft/yii2-bootstrap5/src/Nav.php',
        // '../vendor/yiisoft/yii2-bootstrap5/src/NavBar.php',
        // '../vendor/yiisoft/yii2-bootstrap5/src/ActiveForm.php',
        // '../vendor/yiisoft/yii2-bootstrap5/src/ActiveField.php',
        // '../vendor/yiisoft/yii2/helpers/**/*.php',
        // '../vendor/yiisoft/yii2/widgets/**/*.php',
        '../vendor/yiisoft/yii2/assets/**/*.js',
        './src/**/*.js'
    ],
    css: ['src/css/bootstrap.min.css'],
    safelist: ['tooltip', 'tooltip-arrow', 'bs-tooltip-auto', 'tooltip-inner'],
    variables: true
}