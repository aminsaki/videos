<template>
  <div class="bg-gray-100 d-flex justify-content-center align-items-center p-4" style="direction: rtl">
    <div class="col-md-6 bg-white shadow-2xl rounded-3xl p-3 border border-gray-300 " style="margin-top: 140px;">
      <div class="d-flex justify-content-end">
         <router-link to="/panel/dashboard/links" class="title btn btn-outline-success  ">مشاهد لینک ها</router-link>
      </div>
        <form @submit.prevent="btn_create">
          <div class="mb-4">
            <label for="title" class="block text-gray-700 font-semibold mb-2">دسته بندی</label>
            <select id="product" v-model="data.categorios" style="direction: rtl"
                    class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500">
              <option value="" selected>لطفا یکی از گزینه را انتخاب کنید</option>
              <option v-for=" (key ,val) in categories "  :value="key.id" > {{key.name }}</option>
            </select>
          </div>
          <div class="mb-4">
            <label for="title" class="block text-gray-700 font-semibold mb-2">عنوان لینک</label>
            <input v-model="data.title" type="text" id="title" class="form-control p-3 rounded-xl shadow-sm" placeholder="عنوان را وارد کنید">
          </div>
          <div class="mb-4">
            <label for="url" class="block text-gray-700 font-semibold mb-2">لینک</label>
            <input v-model="data.url" type="url" id="url" class="form-control p-3 rounded-xl shadow-sm" placeholder="لینک را وارد کنید">
          </div>
          <div class="mb-4">
            <label for="description" class="block text-gray-700 font-semibold text-lg mb-2">توضیحات</label>
            <textarea v-model="data.description" id="description" rows="4" class="form-control p-3 rounded-xl shadow-sm text-lg" placeholder="توضیحات را وارد کنید"></textarea>
          </div>
          <button
            type="submit"
            :disabled="loading"
            class="w-full text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 flex justify-center items-center">
            <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
            <span>{{ loading ? 'در حال ارسال...' : 'ثبت کردن' }}</span>
          </button>
        </form>
    </div>
  </div>
</template>

<script setup>
import axios from 'axios';
import { toast } from 'vue3-toastify';
import {myErrors} from "@/commons/helpers/errors.js";
import {$ref} from "unplugin-vue-macros/macros";

let loading = $ref(false);

const data = $ref({
  title: '',
  url: '',
  description: '',
  categorios:''
});
let categories = $ref();

async function getCat() {
  // loading= true;
  try {
    const response = await axios.get("categories", data);
    if (response.data.status === 'true') {
       categories =JSON.parse(JSON.stringify(response.data.data));
    }
  } catch (errors) {
    myErrors(errors);
  }
}

async function btn_create() {
  // loading= true;
  try {
    const response = await axios.post("links", data);
    if (response.data.status === 'true') {
      loading = false;
      return toast.success(response.data.messages);
    }
  } catch (errors) {
    loading = false;
    myErrors(errors);
  }
}

getCat()
</script>
