<?php

$arquivo = fopen('cursos-php.txt', 'a+');

$curso = "\nDesign Patterns PHP II: Boas práticas de programação";

fwrite($arquivo, $curso);

fclose($arquivo);
