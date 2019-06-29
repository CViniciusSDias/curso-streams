<?php

$arquivo = fopen('lista-cursos.txt', 'r');

$tamanhoDoArquivo = filesize('lista-cursos.txt');
$cursos = fread($arquivo, $tamanhoDoArquivo);

echo $cursos;

fclose($arquivo);
