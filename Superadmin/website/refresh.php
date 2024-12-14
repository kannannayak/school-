<?php
if (isset($_POST['refresh'])) {
    header('location:retail_user');
}
//payment
if (isset($_POST['refresh_pay'])) {
    header('location:payments');
}
//payment report
if (isset($_POST['refresh_pay_report'])) {
    header('location:payment_report');
}
//whole
if (isset($_POST['refresh_whole_user'])) {
    header('location:wholesale_user');
}
//product
if (isset($_POST['refresh_product'])) {
    header('location:products');
}
//product
if (isset($_POST['refresh_product_report'])) {
    header('location:product_report');
}
//oreder
if (isset($_POST['refresh_order'])) {
    header('location:orders');
}
//oreder report
if (isset($_POST['refresh_order_report'])) {
    header('location:order_report');
}
//retail user report
if (isset($_POST['refresh_retail_report'])) {
    header('location:retail_user_report');
}
//whole user report
if (isset($_POST['refresh_whole_user_report'])) {
    header('location:wholesale_user_report');
}

if (isset($_POST['refresh_pay_fail'])) {
    header('location:reject_payments');
}
?>