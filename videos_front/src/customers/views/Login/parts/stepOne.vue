<template>
  <form action="#" @submit.prevent="btn_login()">
    <img src="@/commons/assets/images/logo.png" class="img-fluid" alt="">
    <label class="p-4">
      ورود به حساب کاربری <i class="fa fa-user text-rose-500"></i>
    </label>
    <br>
    <!-- فیلد شماره موبایل -->
    <div class="d-flex justify-content-center w-100"  v-if="!showNameField">
      <input type="text" v-model="mobile" maxlength="11" minlength="11"
             class="p-3  form-control  "
             placeholder="شماره تلفن همراه خود را وارد کنید"/>
    </div>

    <div class="d-flex justify-content-end w-100" v-if="showNameField">
     <label class="w-100">
      <input type="text" v-model="username"
             class="p-3  form-control  "
             placeholder="نام و نام خانوادگی خود را وارد کنید"/>
     </label>
    </div>

    <button @click="btn_login()" type="button" v-if="statusFirst === 'false'"
            class="form-control my-5 text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
      تایید و ادامه
    </button>

    <button v-if="statusFirst === 'true'" disabled type="button"
            class="mt-20 text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
      <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-gray-200 animate-spin dark:text-gray-600"
           viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
          fill="currentColor"/>
        <path
          d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
          fill="#1C64F2"/>
      </svg>
      ... درحال ارسال کد
    </button>

  </form>
</template>

<script setup>
import {$ref} from 'unplugin-vue-macros/macros';
import * as err from "@/commons/helpers/errors.js";
import {checkEmptyInput, checkEmptyInput_mobile} from "@/commons/helpers/validations.js";
import axios from "axios";

const emit = defineEmits(['stepOne']);
const props = defineProps({
  back_mobile: {type: Number}
})

let mobile = props.back_mobile ? props.back_mobile : "";
let username = $ref("");  // ذخیره نام کاربر
let statusFirst = $ref("false");
let checkName = "";
let showNameField = $ref(false);  // نمایش یا عدم نمایش فیلد نام

async function btn_login() {
   if(showNameField){
     checkEmptyInput(username ,"نام خانوادگی الزامی است.")
     }
  checkEmptyInput_mobile(mobile);
  statusFirst = 'true';

  try {
    const response = await axios.get(`loginOtp?mobile=${mobile}&name=${username}`);
    if (response.data.status === "true") {
      if (response.data.data && response.data?.data?.name) {
        checkName = response.data.data.name;
      } else {
        statusFirst = 'false';
        showNameField = true;  // نمایش فیلد نام در صورت عدم وجود
        return;
      }
      statusFirst = 'false';
      return emit("stepTwo", mobile);
    }
  } catch (error) {
    console.log(error);
    statusFirst = 'false';
    err.myErrors(error);
  }
}

</script>
