<?php
class CpfValidator
{
public static function validate($cpf)
{
// Remove caracteres não numéricos
$cpf = preg_replace('/[^0-9]/', '', $cpf);
// Verifica se o número de dígitos é igual a 11
if (strlen($cpf) != 11) {
return false;
}
// Elimina CPFs conhecidos inválidos
if (preg_match('/(\d)\1{10}/', $cpf)) {
return false;

}
// Valida os dois dígitos verificadores
for ($t = 9; $t < 11; $t++) {
for ($d = 0, $c = 0; $c < $t; $c++) {
$d += $cpf[$c] * (($t + 1) - $c);
}
$d = ((10 * $d) % 11) % 10;
if ($cpf[$c] != $d) {
return false;
}
}
return true;
}
}