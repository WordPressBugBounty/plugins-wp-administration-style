(() => {
    window.addEventListener('load', () => {
        if (!document.body.classList.contains('block-editor-page')) return;

        let countInterval = 0;

        const interval = setInterval(() => {
            if (countInterval > 20) return;
            countInterval += 1;

            const iframe = document.querySelector('.block-editor-iframe__scale-container [name=editor-canvas]');

            if (!iframe.contentWindow.document.head) return;

            const vazirmatnLinkElement = document.getElementById('wp-administration-style-vazirmatn-link').cloneNode(true);
            const vazirmatnNlLinkElement = document.getElementById('wp-administration-style-vazirmatn-nl-link').cloneNode(true);

            vazirmatnLinkElement.removeAttribute('rel');
            vazirmatnNlLinkElement.removeAttribute('rel');

            iframe.contentWindow.document.head.appendChild(vazirmatnLinkElement);
            iframe.contentWindow.document.head.appendChild(vazirmatnNlLinkElement);

            iframe.contentWindow.document.head.appendChild(document.getElementById('wp-administration-style-vazirmatn-style').cloneNode(true));

            iframe.contentWindow.document.head.insertAdjacentHTML(
                'beforeend',
                `
                    <style id="wp-administration-style-font-family-for-gutenberg">
                        :root {
                            /* twentytwentyfive side-editor fonts */
                            --wp--preset--font-family--manrope: var(--wp-administration-style--font-family--vazirmatn-nl), Manrope, sans-serif !important;
                            --wp--preset--font-family--fira-code: var(--wp-administration-style--font-family--vazirmatn-nl), "Fira Code", monospace !important;
                            --wp--preset--font-family--beiruti: var(--wp-administration-style--font-family--vazirmatn-nl), Beiruti, sans-serif !important;
                            --wp--preset--font-family--literata: var(--wp-administration-style--font-family--vazirmatn-nl), Literata, serif !important;
                            --wp--preset--font-family--vollkorn: var(--wp-administration-style--font-family--vazirmatn-nl), Vollkorn, serif !important;
                            --wp--preset--font-family--platypi: var(--wp-administration-style--font-family--vazirmatn-nl), Platypi !important;
                            --wp--preset--font-family--ysabeau-office: var(--wp-administration-style--font-family--vazirmatn-nl), "Ysabeau Office", sans-serif !important;
                            --wp--preset--font-family--roboto-slab: var(--wp-administration-style--font-family--vazirmatn-nl), "Roboto Slab", serif !important;
                            --wp--preset--font-family--fira-sans: var(--wp-administration-style--font-family--vazirmatn-nl), "Fira Sans", sans-serif !important;
                        }
                    </style>
                `,
            );

            clearInterval(interval);
        }, 200);
    });
})();
