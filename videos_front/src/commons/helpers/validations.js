import * as msg from "./msg.js";
import {toast} from "vue3-toastify";

export function checkEmptyInput(param, message) {
    if (!param) {
        throw new msg.Errors(message)
    }
}



export function checkEmptyInput_mobile(mobile) {


    if (!mobile || mobile.length !== 11) {
        throw new msg.Errors("شماره  تلفن همراه وارد شده اشتباه می باشد")
    }
}
export function checkEmptyInput_code(codes) {

    if (codes.length !== 6) {
        throw new msg.Errors("کد اجباری می باشد")
    }
}

export function validateForm(data) {
    const errors = {};

    if (!data.firstName) {
        errors.firstName = 'نام الزامی است.';
    }

    if (!data.lastName) {
        errors.lastName = 'نام خانوادگی الزامی است.';
    }

    const mobileRegex = /^09\d{9}$/;
    if (!data.mobile || !mobileRegex.test(data.mobile)) {
        errors.mobile = 'شماره موبایل معتبر نیست.';
    }

    const nationalCodeRegex = /^\d{10}$/;
    if (!data.nationalCode || !nationalCodeRegex.test(data.nationalCode)) {
        errors.nationalCode = 'کد ملی باید 10 رقم باشد.';
    }

    if (!data.price || isNaN(data.price)) {
        errors.price = 'مبلغ باید عددی معتبر باشد.';
    }

    return errors;
}


