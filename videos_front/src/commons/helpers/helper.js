export function formatPrice(price) {

    return new Intl.NumberFormat('fa-IR', {
        currency: 'IRR',
        minimumFractionDigits: 0
    }).format(price);
}

const formatInput = (data) => {
     let formattedValue;
    let value = data.price.replace(/\D/g, ''); // حذف کاراکترهای غیرعددی
    if (value) {
        formattedValue = parseInt(value).toLocaleString('fa-IR');
    } else {
        formattedValue = '';
    }
    return formattedValue;
};