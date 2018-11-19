<?php
$this->title = '页面未找到';
?>

<style>
    html, body {
        height: 100%;
        background: #fff;
        color: #666666;
    }

    .site-error{
        text-align: center;
        padding-top: 100px;
    }

    .site-error a{
        color: #0088cc;
    }

</style>
<div class="container">
    <div class="site-error">
        <h4>对不起,该文档已被删除,无法查看</h4>
        <p><span id="second">60</span>秒后,自动返回首页</p>
        <p>
            <a href="/">如果没有自动跳转,请点击此链接</a>
        </p>
    </div>
</div>
<script>
    var time = 59;
    setInterval(function(){
        time--;
        if(time < 1){
            window.location.href = './';
        }
        document.getElementById('second').innerText = time;

    }, 1000);
</script>
