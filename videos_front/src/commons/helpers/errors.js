import * as msg from "./msg.js";
export function myErrors(error) {

    if (error?.response?.status === 422) {
        const errorMessages = Object.values(error.response.data.errors).map(val => val[0]);
        errorMessages.forEach(errorMessage => {
              msg.Errors(errorMessage)
        });
    } else if (error?.response?.status === 404) {
        if (error?.response?.data?.messages) {
            msg.Errors(error?.response?.data?.messages);
        } else {
            msg.Errors('یک خطای غیرمنتظره رخ داد.');
        }
    } else {
        msg.Errors('یک خطای غیرمنتظره رخ داد.');
    }
}