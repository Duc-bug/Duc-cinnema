$(document).ready(function () {
    let seatPrice = { normal: 50000, vip: 100000, sweetbox: 120000 };
    let selectedSeats = [];
    let seatTypes = ["normal", "vip", "sweetbox"];

    // Hàm định dạng số tiền
    function formatCurrency(amount) {
        return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Hàm cập nhật danh sách ghế đã chọn
    function updateSelectedSeatsList() {
        if (selectedSeats.length === 0) {
            $('#selected-seats-list').text("Chưa chọn ghế nào");
        } else {
            const seatNumbers = selectedSeats.map(seat => seat.id).join(", ");
            $('#selected-seats-list').text(seatNumbers);
        }
    }

    // Tạo ghế
    for (let i = 1; i <= 100; i++) {
        let seatClass = seatTypes[Math.floor(Math.random() * seatTypes.length)];
        let occupied = Math.random() < 0.2 ? "occupied" : "";
        $('#seats').append(`<div class="seat ${seatClass} ${occupied}" data-id="${i}" data-type="${seatClass}">${i}</div>`);
    }

    // Xử lý chọn ghế
    $('.seat').not('.occupied').click(function () {
        $(this).toggleClass('selected');
        let seatId = $(this).data('id');
        let seatType = $(this).data('type');

        if ($(this).hasClass('selected')) {
            selectedSeats.push({ id: seatId, type: seatType });
        } else {
            selectedSeats = selectedSeats.filter(s => s.id !== seatId);
        }

        // Cập nhật danh sách ghế đã chọn
        updateSelectedSeatsList();

        // Tính tổng tiền
        let moviePrice = parseInt($('#movie').val());
        let total = selectedSeats.reduce((sum, seat) => sum + seatPrice[seat.type], 0) + moviePrice;
        $('#total').text(formatCurrency(total));
    });

    // Xử lý thanh toán
    $('#pay').click(function () {
        if (selectedSeats.length === 0) {
            alert("Vui lòng chọn ít nhất một ghế để thanh toán!");
            return;
        }

        // Lấy danh sách ghế đã chọn, loại ghế và thông tin phim
        const seatNumbers = selectedSeats.map(seat => seat.id).join(", ");
        const seatTypes = selectedSeats.map(seat => seat.type).join(", ");
        const movieName = $('#movie option:selected').text(); // Lấy tên phim
        const total = $('#total').text();

        // Chuyển hướng sang trang thanh toán và truyền dữ liệu qua URL
        window.location.href = `thanhtoan.html?seats=${encodeURIComponent(seatNumbers)}&types=${encodeURIComponent(seatTypes)}&movie=${encodeURIComponent(movieName)}&total=${encodeURIComponent(total)}`;
    });
});


