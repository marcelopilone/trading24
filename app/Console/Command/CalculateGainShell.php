<?php

class CalculateGainShell extends AppShell {

    public function main() {

        $startPrice = $this->args[0];
        $buyPrice   = $this->args[1];
        $sellPrice  = $this->args[2];

        $buy        = $startPrice / $buyPrice * $sellPrice;
        $wonPercent = $buy * 100 / $startPrice - 100;


        $this->out('Empezaste con '.$startPrice.' compraste por '.$buyPrice.' dolares, vendite por '.$sellPrice.' y terminarias con: '.$buy.' dolares');
        $this->out('Ganaste un '.$wonPercent.' %');


    }

}