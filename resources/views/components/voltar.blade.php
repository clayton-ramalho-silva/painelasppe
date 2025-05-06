@props(['rota'])

<a href="{{ $rota }}" class="btn-voltar">
    <div class="icone-voltar">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19,6a1,1,0,0,0-1,1v4a1,1,0,0,1-1,1H7.41l1.3-1.29A1,1,0,0,0,7.29,9.29l-3,3a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l3,3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L7.41,14H17a3,3,0,0,0,3-3V7A1,1,0,0,0,19,6Z"></path></svg>

    </div>
    <span>Voltar</span>
</a>


<style>
    .btn-voltar{
    box-sizing: border-box;
    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.16);
    font-family: 'Montserrat';
    font-size: 12px;
    letter-spacing: 2px;
    position: relative;
    border-radius: 50px;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    width: 105px;
    padding: 5px 5px 5px 5px;

}

.icone-voltar{
    background: #F8F8F8;
    border-radius: 50px;
    -moz-border-radius: 50px;
    -webkit-border-radius: 50px;
    -ms-border-radius: 50px;
    width: 30px;
    height: 30px;
    display: flex;
    justify-content: center;
    align-items: center;    
}
.icone-voltar svg{
    overflow: visible;
    width: 20px;
    height: auto;
    stroke: #183550;

}
.btn-voltar span{
color: gray;
margin-left: 10px;
}
</style>