(function ($) {
  $(function () {
    const $searchInput = $('.theme-search input');
    if ($searchInput.length && window.macsoftSettings) {
      $searchInput.attr('placeholder', window.macsoftSettings.search_placeholder);
    }

    $('.filter-tabs a').on('click', function (event) {
      if (this.dataset.filter) {
        event.preventDefault();
        const filter = this.dataset.filter;
        $('.filter-tabs a').removeClass('active');
        $(this).addClass('active');
        $('.app-grid article').each(function () {
          const categories = $(this).data('categories') || '';
          if (filter === 'all' || categories.includes(filter)) {
            $(this).show();
          } else {
            $(this).hide();
          }
        });
      }
    });
  });
})(jQuery);
