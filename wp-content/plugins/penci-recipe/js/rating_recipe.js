(function ($) {
	"use strict";

	var PENCI_RECIPE = PENCI_RECIPE || {};

	PENCI_RECIPE.penci_rating_recipe = function () {
		if ($(".penci_rateyo").length) {
			$(".penci_rateyo").each(function () {
				var $this = $(this),
					rate = parseFloat($this.data("rate")),
					allow = $this.data("allow"),
					total = $this.data("total"),
					postidsub = $this.data("postidsub"),
					people_numb = parseInt($this.data("people"));

				$this.rateYo({
					rating: rate,
					fullStar: true,
					starWidth: "13px",
					spacing: "3px",
					onSet: function (rating) {
						$this.rateYo("option", "readOnly", true);
						var postid = $this.data("postid");

						$.ajax({
							type: "POST",
							url: PENCI.ajaxUrl,
							dataType: "html",
							data: {
								action: "penci_rateyo",
								nonce: PENCI.nonce,
								postid: postid,
								postidsub: postidsub,
								rating: rating,
							},
							success: function (data) {
								var parent = $this.parent(),
									new_rate =
										(total + rating) / (people_numb + 1);
								parent.find(".penci-rate-number").html(new_rate.toPrecision(2));
								parent.find(".penci-number-people").html(people_numb + 1);
								$this.rateYo("rating", new_rate);
							},
							error: function () {
								console.error("AJAX request failed.");
							},
						});
					},
				});

				if (allow == "0") {
					$this.rateYo("option", "readOnly", true);
				}
			});
		}
	};

	PENCI_RECIPE.penci_rating_recipe_review = function () {

		if ( ! PENCI.ajax_review ) {
			return;
		}

		$(".penci-recipe-review").each(function () {
			var $this = $(this),
				recipe_id = $this.data("recipe-id");

			if ($this.hasClass("penci-recipe-review-loaded")) {
				return;
			}

			$.ajax({
				type: "POST",
				url: PENCI.ajaxUrl,
				dataType: "html",
				data: {
					action: "penci_get_recipe_rating",
					nonce: PENCI.nonce,
					recipe_id: recipe_id,
				},
				success: function (data) {
					$this.html(data);
					$this.addClass("penci-recipe-review-loaded");
					PENCI_RECIPE.penci_rating_recipe();
				},
				error: function () {
					console.error("AJAX request failed.");
				},
			});
		});
	}

	$(document).ready(function () {
		PENCI_RECIPE.penci_rating_recipe();
		PENCI_RECIPE.penci_rating_recipe_review();
	});

	$(window).on("elementor/frontend/init", function () {
		if (window.elementorFrontend && elementorFrontend.isEditMode()) {
			elementorFrontend.hooks.addAction(
				"frontend/element_ready/penci-recipe.default",
				function () {
					PENCI_RECIPE.penci_rating_recipe();
				}
			);
		}
	});
})(jQuery);