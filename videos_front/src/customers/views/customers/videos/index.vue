<template>
  <div class="container my-5">
    <h1 class="text-center mb-4">ویدیو پلیرها</h1>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      <div v-for="(video, index) in videos" :key="index" class="col">
        <div class="card shadow-sm h-200">
          <video
            ref="videoPlayers"
            class="video-js vjs-default-skin card-img-top"
            controls
            preload="auto"
            width="100%"
            height="auto"
            :poster="video.poster"
            @play="onPlay(index)"
             style="height:480px;"
            >
            <source :src="video.src" type="video/mp4" />
            <track
              kind="subtitles"
              :src="video.subtitle"
              srclang="fa"
              label="فارسی"
              default
            />
            <p>Your browser doesn't support HTML5 video. Upgrade your browser to view this content.</p>
          </video>
          <div class="card-body">
            <h5 class="card-title">ویدیو شماره {{ index + 1 }}</h5>
            <p class="card-text">
              این یک توضیح کوتاه برای ویدیوی شماره {{ index + 1 }} است. شما می‌توانید زیرنویس فارسی را فعال کنید.
            </p>
          </div>
          <div class="card-footer text-center">
            <button class="btn btn-primary btn-sm">بیشتر بدانید</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import videojs from "video.js";
import "video.js/dist/video-js.css";
const background1 = new URL("@/customers/assets/305043.jpg", import.meta.url);

// لیست ویدیوها با عکس پیش‌نمایش
const videos = ref([
  {
    src: "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/origin_C8mj5h0U4gqnaXFzKm9i2EP7bdDcvXhecE9uqUbf.mp4",
    subtitle:
      "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/fa_YO40iR8fShFlBZ28JSVYS51iCcVcMM6OKKrrHQ6c.vtt",
    poster: background1, // پوستر ویدیو
    background: background1, // تصویر پس‌زمینه
  },
  {
    src: "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/origin_C8mj5h0U4gqnaXFzKm9i2EP7bdDcvXhecE9uqUbf.mp4",
    subtitle:
      "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/fa_YO40iR8fShFlBZ28JSVYS51iCcVcMM6OKKrrHQ6c.vtt",
    poster: background1, // پوستر ویدیو
    background: background1, // تصویر پس‌زمینه
  },
  {
    src: "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/origin_C8mj5h0U4gqnaXFzKm9i2EP7bdDcvXhecE9uqUbf.mp4",
    subtitle:
      "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/fa_YO40iR8fShFlBZ28JSVYS51iCcVcMM6OKKrrHQ6c.vtt",
    poster: background1, // پوستر ویدیو
    background: background1, // تصویر پس‌زمینه
  },
  {
    src: "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/origin_C8mj5h0U4gqnaXFzKm9i2EP7bdDcvXhecE9uqUbf.mp4",
    subtitle:
      "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/fa_YO40iR8fShFlBZ28JSVYS51iCcVcMM6OKKrrHQ6c.vtt",
    poster: background1, // پوستر ویدیو
    background: background1, // تصویر پس‌زمینه
  },
  {
    src: "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/origin_C8mj5h0U4gqnaXFzKm9i2EP7bdDcvXhecE9uqUbf.mp4",
    subtitle:
      "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/fa_YO40iR8fShFlBZ28JSVYS51iCcVcMM6OKKrrHQ6c.vtt",
    poster: background1, // پوستر ویدیو
    background: background1, // تصویر پس‌زمینه
  },
  {
    src: "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/origin_C8mj5h0U4gqnaXFzKm9i2EP7bdDcvXhecE9uqUbf.mp4",
    subtitle:
      "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/fa_YO40iR8fShFlBZ28JSVYS51iCcVcMM6OKKrrHQ6c.vtt",
    poster: background1, // پوستر ویدیو
    background: background1, // تصویر پس‌زمینه
  },
  {
    src: "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/origin_C8mj5h0U4gqnaXFzKm9i2EP7bdDcvXhecE9uqUbf.mp4",
    subtitle:
      "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/fa_YO40iR8fShFlBZ28JSVYS51iCcVcMM6OKKrrHQ6c.vtt",
    poster: background1, // پوستر ویدیو
    background: background1, // تصویر پس‌زمینه
  },
  {
    src: "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/origin_C8mj5h0U4gqnaXFzKm9i2EP7bdDcvXhecE9uqUbf.mp4",
    subtitle:
      "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/fa_YO40iR8fShFlBZ28JSVYS51iCcVcMM6OKKrrHQ6c.vtt",
    poster: background1, // پوستر ویدیو
    background: background1, // تصویر پس‌زمینه
  },  {
    src: "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/origin_C8mj5h0U4gqnaXFzKm9i2EP7bdDcvXhecE9uqUbf.mp4",
    subtitle:
      "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/fa_YO40iR8fShFlBZ28JSVYS51iCcVcMM6OKKrrHQ6c.vtt",
    poster: background1, // پوستر ویدیو
    background: background1, // تصویر پس‌زمینه
  },
  {
    src: "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/origin_C8mj5h0U4gqnaXFzKm9i2EP7bdDcvXhecE9uqUbf.mp4",
    subtitle:
      "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/fa_YO40iR8fShFlBZ28JSVYS51iCcVcMM6OKKrrHQ6c.vtt",
    poster: background1, // پوستر ویدیو
    background: background1, // تصویر پس‌زمینه
  },
  {
    src: "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/origin_C8mj5h0U4gqnaXFzKm9i2EP7bdDcvXhecE9uqUbf.mp4",
    subtitle:
      "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/fa_YO40iR8fShFlBZ28JSVYS51iCcVcMM6OKKrrHQ6c.vtt",
    poster: background1, // پوستر ویدیو
    background: background1, // تصویر پس‌زمینه
  },
  {
    src: "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/origin_C8mj5h0U4gqnaXFzKm9i2EP7bdDcvXhecE9uqUbf.mp4",
    subtitle:
      "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/fa_YO40iR8fShFlBZ28JSVYS51iCcVcMM6OKKrrHQ6c.vtt",
    poster: background1, // پوستر ویدیو
    background: background1, // تصویر پس‌زمینه
  },
  {
    src: "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/origin_C8mj5h0U4gqnaXFzKm9i2EP7bdDcvXhecE9uqUbf.mp4",
    subtitle:
      "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/fa_YO40iR8fShFlBZ28JSVYS51iCcVcMM6OKKrrHQ6c.vtt",
    poster: background1, // پوستر ویدیو
    background: background1, // تصویر پس‌زمینه
  },
  {
    src: "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/origin_C8mj5h0U4gqnaXFzKm9i2EP7bdDcvXhecE9uqUbf.mp4",
    subtitle:
      "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/fa_YO40iR8fShFlBZ28JSVYS51iCcVcMM6OKKrrHQ6c.vtt",
    poster: background1, // پوستر ویدیو
    background: background1, // تصویر پس‌زمینه
  },
  {
    src: "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/origin_C8mj5h0U4gqnaXFzKm9i2EP7bdDcvXhecE9uqUbf.mp4",
    subtitle:
      "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/fa_YO40iR8fShFlBZ28JSVYS51iCcVcMM6OKKrrHQ6c.vtt",
    poster: background1, // پوستر ویدیو
    background: background1, // تصویر پس‌زمینه
  },
  {
    src: "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/origin_C8mj5h0U4gqnaXFzKm9i2EP7bdDcvXhecE9uqUbf.mp4",
    subtitle:
      "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/fa_YO40iR8fShFlBZ28JSVYS51iCcVcMM6OKKrrHQ6c.vtt",
    poster: background1, // پوستر ویدیو
    background: background1, // تصویر پس‌زمینه
  },
  {
    src: "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/origin_C8mj5h0U4gqnaXFzKm9i2EP7bdDcvXhecE9uqUbf.mp4",
    subtitle:
      "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/fa_YO40iR8fShFlBZ28JSVYS51iCcVcMM6OKKrrHQ6c.vtt",
    poster: background1, // پوستر ویدیو
    background: background1, // تصویر پس‌زمینه
  },
  {
    src: "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/origin_C8mj5h0U4gqnaXFzKm9i2EP7bdDcvXhecE9uqUbf.mp4",
    subtitle:
      "https://holoo.arvanvod.ir/Ply7MlZbjB/EX8n3yxKo3/fa_YO40iR8fShFlBZ28JSVYS51iCcVcMM6OKKrrHQ6c.vtt",
    poster: background1, // پوستر ویدیو
    background: background1, // تصویر پس‌زمینه
  },


  // ویدیوهای دیگر...
]);

const videoPlayers = ref([]);
let players = [];

// مقداردهی پلیرها
onMounted(() => {
  videoPlayers.value.forEach((video, index) => {
    players[index] = videojs(video, {}, () => {
      console.log(`Player ${index} is ready!`);
    });
  });
});

// حذف پلیرها هنگام تخریب کامپوننت
onBeforeUnmount(() => {
  players.forEach((player) => {
    if (player) {
      player.dispose();
    }
  });
});

// مدیریت پخش تنها یک ویدیو
const onPlay = (activeIndex) => {
  players.forEach((player, index) => {
    if (index !== activeIndex && !player.paused()) {
      player.pause(); // توقف پلیرهای دیگر
    }
  });
};
</script>

<style scoped>
.video-js {
  font-family: Arial, sans-serif;
  background-color: black;
}

.vjs-text-track-cue {
  direction: rtl;
  text-align: center;
  font-size: 18px;
  color: #fff;
  background-color: rgba(0, 0, 0, 0.7);
}
</style>
