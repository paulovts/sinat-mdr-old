<?php
/**
 * Created by PhpStorm.
 * User: websis
 * Date: 29/09/20
 * Time: 17:12
 */

var_dump( $_SESSION);die;

$postdata = file_get_contents("php://input");

var_dump($postdata);die;

$dados = $_POST;

