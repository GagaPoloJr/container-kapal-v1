<div x-data="{open: false}" x-show="open" @notify.window="Toastify({
    text: $event.detail.message,
    className: 'info',
    close: true,
    style: {
        background:($event.detail.title === 'success') ? '#4caf50' : '#f28888',
      },
  }).showToast()">

</div>
