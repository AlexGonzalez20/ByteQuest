<style>
    .vidas {
        font-size: 28px;
        color: red;
    }
    .vidas .vacia {
        color: lightgray;
    }
</style>

<div class="vidas">
    @for ($i = 0; $i < $vidas->cantidad; $i++)
        <span>❤️</span>
    @endfor
    @for ($j = $vidas->cantidad; $j < 5; $j++)
        <span class="vacia">❤️</span>
    @endfor
</div>
