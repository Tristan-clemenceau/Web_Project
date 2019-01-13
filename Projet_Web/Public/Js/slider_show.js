//VARIABLES
var slideIndex = -1;
var x = ["url('Public/Images/slide_001.jpg')","url('Public/Images/slide_002.jpg')","url('Public/Images/slide_003.jpg')","url('Public/Images/slide_004.jpg')","url('Public/Images/slide_005.png')","url('Public/Images/slide_006.jpg')","url('Public/Images/slide_007.jpg')"];
carousel();

//METHODES
function carousel() {
  slideIndex++;
  if (slideIndex>x.length-1) {
    slideIndex=0;
  }
  document.body.style.backgroundImage=x[slideIndex];
  setTimeout(carousel, 30000); // temps en sec
}