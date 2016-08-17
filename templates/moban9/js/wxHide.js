/**
 * Created by lqzpeng on 2016/3/9.
 */

window.onload=function(){
    var hide=document.getElementById('wxHide');
    var show=document.getElementById('wxShow');
    var ic=document.getElementById('icon');

    hide.onmouseover=function()
    {
        show.style.display='block'
    };
    hide.onmouseout=function()
    {
        show.style.display='none'
    };


    var btn=document.getElementById('navHide');
    var box=document.getElementById('navBox');

    btn.onmouseover=function()
    {
        box.style.display='block';
    };
    btn.onmouseout=function()
    {
        box.style.display='none'
    }


    var odiv=document.getElementById('hide');
    if(odiv != null){
        var btna=odiv.getElementsByTagName('li');
        var showa=odiv.getElementsByTagName('div');

        for(i=0;i<btna.length;i++)
        {
            btna[i].index=i;
            btna[i].onmouseover=function(){

                for(i=0;i<btna.length;i++)
                {
                    btna[i].className='';
                    showa[i].style.display='none';
                }
                this.className='active';
                showa[this.index].style.display='block';
            }
        }
    }
};