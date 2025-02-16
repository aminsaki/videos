export const AuthUser = (to, from, next) => {
  document.title = to.meta?.title ?? 'صفحه اصلی';

  let token = localStorage.getItem('token');
  let users = localStorage.getItem('users');

  if (token && users) {
    if (to.path !== '/panel/dashboard') {
      return next('/panel/dashboard'); // فقط اگر مقصد این مسیر نیست هدایت شود
    }
  } else {
    if (to.path !== '/') {
      return next('/'); // فقط اگر در صفحه اصلی نیست به صفحه اصلی هدایت شود
    }
  }
  next(); // در غیر این صورت ادامه بده
};


