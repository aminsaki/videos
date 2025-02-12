export function closeModels(elements) {
    var modalElement = document.getElementById(elements);
    if (modalElement) {
        modalElement.classList.remove('show');
        modalElement.style.display = 'none';
        modalElement.setAttribute('aria-hidden', 'true');
        modalElement.removeAttribute('aria-modal');
        modalElement.removeAttribute('role');
    }

    // حذف کلاس 'modal-open' از body
    document.body.classList.remove('modal-open');
    document.body.style.overflow = ''; // تنظیم مجدد overflow

    // انتخاب و حذف تمام عناصر پس‌زمینه با کلاس 'modal-backdrop'
    var backdropElements = document.querySelectorAll('.modal-backdrop');
    backdropElements.forEach(function (backdrop) {
        backdrop.classList.remove('show');
        backdrop.style.opacity = '0';

        // پس از یک تاخیر کوتاه، عنصر پس‌زمینه را از DOM حذف کنید
        setTimeout(function () {
            backdrop.remove();
        }, 150); // مدت زمان تاخیر (به میلی‌ثانیه)
    });
}
