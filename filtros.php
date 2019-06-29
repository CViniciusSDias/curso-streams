<?php

$arquivoCursos = fopen('lista-cursos.txt', 'r');

stream_filter_append($arquivoCursos, 'string.toupper');

echo fread($arquivoCursos, filesize('lista-cursos.txt'));
