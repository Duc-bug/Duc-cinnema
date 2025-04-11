function addMessage(sender, text) {
  const msg = document.createElement("div");
  msg.innerHTML = `<strong>${sender}</strong>: ${text.replace(/\n/g, "<br>")}`;
  chatContent.appendChild(msg);
  chatContent.scrollTop = chatContent.scrollHeight;
}

document.addEventListener("DOMContentLoaded", function () {
    const slides = document.querySelectorAll(".slide");
    const dots = document.querySelectorAll(".dot");
    const slidesContainer = document.querySelector(".slides");
    let currentIndex = 0;

    function showSlide(index) {
        // Tính toán vị trí cần di chuyển
        const offset = -index * 100; // Mỗi slide chiếm 100% chiều rộng
        slidesContainer.style.transform = `translateX(${offset}%)`;

        // Cập nhật trạng thái cho các dot
        dots.forEach((dot, i) => {
            dot.classList.toggle("bg-gray-800", i === index);
            dot.classList.toggle("bg-gray-400", i !== index);
        });
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % slides.length; // Chuyển sang slide tiếp theo
        showSlide(currentIndex);
    }

    // Hiển thị slide đầu tiên
    showSlide(currentIndex);

    // Tự động chuyển slide sau mỗi 3 giây
    setInterval(nextSlide, 3000);

    // Thêm sự kiện click cho các dot
    dots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
            currentIndex = index;
            showSlide(currentIndex);
        });
    });
});

