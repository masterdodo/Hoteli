function checkInputOnKeyUp (x)
{
    console.log(x);
    if( /(.+)@(.+){2,}\.(.+){2,}/.test(x) )
    {
    console.log('Valid!');
    } else
    {
    console.log('Invalid!');
    }
}