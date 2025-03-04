// Import the config.json file
export const paranGuards = (to, from, next) => {
  document.title = to?.meta?.title ?? 'دانشبورد';
  let token = localStorage.getItem('token');
  let users = localStorage.getItem('users');
  if (token && users) {
    return next();
  }
  return next('/');
};
