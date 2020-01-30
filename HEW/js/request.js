// グローバル変数定義
// html文書がロードされた瞬間に実行される
var rt1,rt2,rt3,rt4,rt5,rt6,rt7,rt8,rt9;
var it1,it2,it3,it4,it5,it6;
var rm1,rm2,rm3,rm4,rm5,rm6,rm7,rm8,rm9;
var im1,im2,im3,im4,im5,im6;

// オンロードイベント
// <body>に指定された各エレメントが表示され準備が整ったら実行される
window.onload =function(){
  rt1 = document.getElementById("r_t1");
  rt2 = document.getElementById("r_t2");
  rt3 = document.getElementById("r_t3");
  rt4 = document.getElementById("r_t4");
  rt5 = document.getElementById("r_t5");
  rt6 = document.getElementById("r_t6");
  rt7 = document.getElementById("r_t7");
  rt8 = document.getElementById("r_t8");
  rt9 = document.getElementById("r_t9");
  it1 = document.getElementById("i_t1");
  it2 = document.getElementById("i_t2");
  it3 = document.getElementById("i_t3");
  it4 = document.getElementById("i_t4");
  it5 = document.getElementById("i_t5");
  it6 = document.getElementById("i_t6");
  rm1 = document.getElementById("r_msg1");
  rm2 = document.getElementById("r_msg2");
  rm3 = document.getElementById("r_msg3");
  rm4 = document.getElementById("r_msg4");
  rm5 = document.getElementById("r_msg5");
  rm6 = document.getElementById("r_msg6");
  rm7 = document.getElementById("r_msg7");
  rm8 = document.getElementById("r_msg8");
  rm9 = document.getElementById("r_msg9");
  im1 = document.getElementById("i_msg1");
  im2 = document.getElementById("i_msg2");
  im3 = document.getElementById("i_msg3");
  im4 = document.getElementById("i_msg4");
  im5 = document.getElementById("i_msg5");
  im6 = document.getElementById("i_msg6");
}

//リクエストの入力チェック
function requestCheck(){
var ret=0;

  if (rt1.value.length>0 && rt1.value.length<=60) {
    rm1.innerHTML="";
  }else{
    rm1.innerHTML="文字数を60文字以内で入力してください";
    ret=1;
  }
  if (rt2.value.length>0 && rt2.value.length<=60) {
    rm2.innerHTML="";
  }else{
    rm2.innerHTML="文字数を60文字以内で入力してください";
    ret=1;
  }
  if (rt4.value.length>0 && rt4.value.length<=25) {
    rm4.innerHTML="";
  }else{
    rm4.innerHTML="文字数を25文字以内で入力してください";
    ret=1;
  }
  if (rt5.value.length>0 && rt5.value.length<=25) {
    rm5.innerHTML="";
  }else{
    rm5.innerHTML="文字数を25文字以内で入力してください";
    ret=1;
  }
  if (rt6.value.length>0 && rt6.value.length<=40) {
    rm6.innerHTML="";
  }else{
    rm6.innerHTML="文字数を40文字以内で入力してください";
    ret=1;
  }
  if (rt7.value.length>0 && rt7.value.length<=60) {
    rm7.innerHTML="";
  }else{
    rm7.innerHTML="文字数を40文字以内で入力してください";
    ret=1;
  }
  if (rt8.value.length>0 && rt8.value.length<=50) {
    rm8.innerHTML="";
  }else{
    rm8.innerHTML="文字数を50文字以内で入力してください";
    ret=1;
  }
  if (rt9.value.length<=800) {
    rm9.innerHTML="";
  }else{
    rm9.innerHTML="文字数を800文字以内で入力してください";
    ret=1;
  }

  if(ret==0){
    setTimeout(idle,2000);
    return true;
  }else{
    setTimeout(idle,10000);
    return false;
  }
}

function idle(){
  rm1.innerHTML = "";
  rm2.innerHTML = "";
  rm3.innerHTML = "";
  rm4.innerHTML = "";
  rm5.innerHTML = "";
  rm6.innerHTML = "";
  rm7.innerHTML = "";
  rm8.innerHTML = "";
  rm9.innerHTML = "";
}

//お問い合わせの入力チェック
function inquiryCheck(){
var ret=0;

  if (it1.value.length>0 && it1.value.length<=800) {
    im1.innerHTML="";
  }else{
    im1.innerHTML="文字数を800文字以内で入力してください";
    ret=1;
  }
  if (it2.value.length>0 && it2.value.length<=25) {
    im2.innerHTML="";
  }else{
    im2.innerHTML="文字数を25文字以内で入力してください";
    ret=1;
  }
  if (it3.value.length>0 && it3.value.length<=25) {
    im3.innerHTML="";
  }else{
    im3.innerHTML="文字数を25文字以内で入力してください";
    ret=1;
  }
  if (it4.value.length>0 && it4.value.length<=40) {
    im4.innerHTML="";
  }else{
    im4.innerHTML="文字数を40文字以内で入力してください";
    ret=1;
  }
  if (it5.value.length>0 && it5.value.length<=40) {
    im5.innerHTML="";
  }else{
    im5.innerHTML="文字数を40文字以内で入力してください";
    ret=1;
  }
  if (it6.value.length>0 && it6.value.length<=50) {
    im6.innerHTML="";
  }else{
    im6.innerHTML="文字数を50文字以内で入力してください";
    ret=1;
  }

  if(ret==0){
    setTimeout(iidle,2000);
    return true;
  }else{
    setTimeout(iidle,10000);
    return false;
  }
}

function iidle(){
  im1.innerHTML = "";
  im2.innerHTML = "";
  im3.innerHTML = "";
  im4.innerHTML = "";
  im5.innerHTML = "";
  im6.innerHTML = "";
}
