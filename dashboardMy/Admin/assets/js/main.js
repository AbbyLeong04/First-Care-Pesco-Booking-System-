// 获取所有菜单项
let list = document.querySelectorAll(".navigation li");

// 高亮当前页面链接
function setActiveLink() {
  const currentPage = window.location.pathname;
  list.forEach((item) => {
    const link = item.querySelector("a").getAttribute("href");
    if (currentPage.includes(link)) {
      item.classList.add("hovered");
    } else {
      item.classList.remove("hovered");
    }
  });
}

// 初始化高亮
setActiveLink();

// 菜单切换逻辑
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};
