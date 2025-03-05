<template>
  <div class="form-container sign-up-container">
    <form action="#">
      <img src="@/commons/assets/images/logo.png" class="img-fluid w-100 mobile_login" alt="">

       <div class="d-flex flex-row justify-content-center " v-if="timers ==='true'">
        <div class="p-2  text-sm ">
          <span>رمز یک‌بار مصرف به شماره <span>{{ mobile }}</span> پیامک شد  </span><br>
        </div>
      </div>

      <div v-if="timers ==='true'" class="mt-3">

        <div class="d-flex flex-row handleInput justify-content-center ">

          <div style="display: flex; align-items: center;">
            <input min="0" max="9" v-on:keyup="handleInput('inputOne','inputTwo','')" maxlength="1" pattern="[0-9]"
                   type="tel"
                   class="otp-input" id="inputOne">
          </div>
          <div style="display: flex; align-items: center;">
            <input min="0" max="9" maxlength="1" pattern="[0-9]" type="tel" class="otp-input" id="inputTwo"
                   v-on:keyup="handleInput('inputTwo','inputThree','')">
          </div>

          <div style="display: flex; align-items: center;">
            <input min="0" max="9" maxlength="1" pattern="[0-9]" type="tel" class="otp-input" id="inputThree"
                   v-on:keyup="handleInput('inputThree','inputFoure','')">
          </div>
          <div style="display: flex; align-items: center;">
            <input min="0" max="9" maxlength="1" pattern="[0-9]" type="tel" class="otp-input" id="inputFoure"
                   v-on:keyup="handleInput('inputFoure','inputFive','')">
          </div>
          <div style="display: flex; align-items: center;">
            <input min="0" max="9" maxlength="1" pattern="[0-9]" type="tel" class="otp-input" id="inputFive"
                   v-on:keyup="handleInput('inputFive','inputSex' ,'')">
          </div>
          <div style="display: flex; align-items: center;">
            <input min="0" max="9" maxlength="1" pattern="[0-9]" type="tel" class="otp-input" id="inputSex"
                   v-on:keyup="handleInput('inputSex','end' , mobile)">
          </div>
        </div>

        <div class="d-flex flex-row mt-2 justify-content-center " v-if="timers ==='true'">
            <h1 class="text-justify p-2" style="text-align: right; font-size: 12px; font-weight: bold;">تا <span
              class="text-danger  " id="date">  {{ date }} </span> ارسال مجدد رمز یک‌بار مصرف به شماره شما امکان‌پذیر
              است.
            </h1>
        </div>

        <div>
        <span
          class="btn mt-2  btn-outline-dark  form-control" @click="pageBack()"
          v-if="timers ==='true'">  ویرایش شماره</span>
        </div>

        <div class="d-flex flex-row mt-2">
          <div class="p-2 w-100 ">

            <button disabled type="button" v-if="statusTwo === 'true'"
                    class=" form-control text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
              <svg aria-hidden="true" role="status"
                   class="inline w-4 h-4 me-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101"
                   fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                  fill="currentColor"/>
                <path
                  d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                  fill="#1C64F2"/>
              </svg>
              ... در حال بررسی کد
            </button>
          </div>
        </div>
      </div>
      <div v-else>
        <h1 class="text-justify p-2 mt-2" style="text-align: justify; font-size: 12px; font-weight: bold;">
          <span @click="restart(mobile)" class="btn   btn-success font-weight-bold">ارسال مجدد</span>
        </h1>
      </div>
    </form>
  </div>
</template>

<script setup>
import * as errors from "@/commons/helpers/errors.js";
import {$ref} from 'unplugin-vue-macros/macros';
import * as empty from "@/customers/commons/Users/emptyInput.js"
import axios from "axios";
import {useRoute} from 'vue-router';
import {onMounted} from "vue";

const route = useRoute();

let arrayIndex = $ref([]);
const props = defineProps({
  mobile: {type: Number}
})
const emit = defineEmits(['stepOne']);

let timers = $ref('true');
let date = $ref();
let codes = "";
let statusTwo = $ref('false');

let name = ""

function pageBack() {
  return emit("stepOne", props.mobile);
}

function handleInput(id, next) {
  let val = document.getElementById(id).value;
  if (val.length !== 1) {
    document.getElementById(id).focus();
    return;
  }
  codes += val;
  if (codes.length === 6) {
    document.getElementById("inputOne").focus();
    sendData(props.mobile);
  }
  if (next === 'end') {
    codes = ""
    document.getElementById("inputOne").focus();
    return false;
  }
  document.getElementById(next).focus();
}

async function sendData() {
  // vali.checkEmptyInput_mobile(props.mobile)
  statusTwo = 'true';
  try {
    const result = await axios.post("loginOtp", {
      "mobile": props.mobile,
      "code": codes,
    });
    let response = result.data
    if (response.status === "true") {
      statusTwo = 'false';
      localStorage.setItem('users', JSON.stringify(response.data.list));
      localStorage.setItem('token', response.data.access_token);
      if (response?.data?.list?.roles[0].name === 'user') {
        window.location.replace(`/videos/${route.params.uid}`);
        return true;
      } else if (response?.data?.list?.roles[0].name === 'admin')
        window.location.replace('/panel/dashboard');
      return true;
    }
    empty.InputdataDocument();
  } catch (error) {
    empty.InputdataDocument();
    statusTwo = 'false';
    errors.myErrors(error)
  }
}

function countdown(totalSeconds) {

  let minutes = Math.floor(totalSeconds / 60);
  let seconds = totalSeconds % 60;
  date = `${padZero(minutes)}:${padZero(seconds)}`;
  if (totalSeconds > 0) {
    setTimeout(function () {
      countdown(totalSeconds - 1);
    }, 1000);
  } else {
    timers = 'false';
  }
}

function padZero(num) {
  return num.toString().padStart(2, '0');
}

async function restart(phone) {
  console.log(phone);
  const response = await axios.get(`loginOtp?mobile=${props.mobile}`);
  if (response.data.status === "true") {
    timers = 'true';
    countdown(2 * 60)
    return true;
  }
}


countdown(2 * 60)


</script>
