<?php

class MeuFiltro extends php_user_filter
{
    private $previousData;

    public function filter($in, $out, &$consumed, $closing)
    {
        $saida = '';

        while ($bucket = stream_bucket_make_writeable($in)) {
            if ($closing && !$bucket->datalen) {
                return PSFS_FEED_ME;
            }
            $consumed += $bucket->datalen;

            $stringFromBucket = $bucket->data;
            if (!empty($this->previousData)) {
                $stringFromBucket = $this->previousData . $bucket->data;
                $this->previousData = null;
            }

            if ($stringFromBucket[-1] !== "\n") {
                $this->previousData = $stringFromBucket;
                return PSFS_FEED_ME;
            }

            $linhas = explode("\n", $stringFromBucket);

            foreach ($linhas as $linha) {
                if (stripos($linha, 'parte') !== false) {
                    $saida .= "$linha\n";
                }
            }
        }

        $bucketSaida = stream_bucket_new($this->stream, $saida);
        stream_bucket_append($out, $bucketSaida);

        return PSFS_PASS_ON;
    }
}
