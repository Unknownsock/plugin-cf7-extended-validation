# CF7 Extended Validation

A WordPress plugin that extends Contact Form 7 with enhanced submit button handling, loading states, and improved user feedback.

## Features

- **Prevents Double Submissions**: Automatically disables the submit button when a form is submitted
- **Visual Feedback**: Shows a loading spinner and changes button text to "Processing..." during submission
- **Smart Re-enabling**: Re-enables the button after successful submission or if errors occur
- **Seamless Integration**: Works automatically with all Contact Form 7 forms on your site
- **Lightweight**: Minimal performance impact with optimized code
- **Accessibility**: Maintains proper button states for screen readers

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- Contact Form 7 plugin installed and activated

## Installation

### From Source (Development)

1. Clone or download this repository
2. Navigate to the project directory
3. Install dependencies:
   ```bash
   npm install
   ```
4. Build the plugin:
   ```bash
   npm run build
   ```
5. Copy the `plugin/cf7-extended-validation` folder to your WordPress plugins directory (`wp-content/plugins/`)
6. Activate the plugin through the WordPress admin panel

### From Plugin File

1. Build the plugin using the steps above
2. Zip the `plugin/cf7-extended-validation` folder
3. Upload and install through WordPress admin panel (Plugins → Add New → Upload Plugin)
4. Activate the plugin

## Usage

Once activated, the plugin works automatically with all Contact Form 7 forms on your site. No configuration needed!

### What Happens When a Form is Submitted:

1. Submit button becomes disabled and shows "Processing..."
2. A loading spinner appears next to the button
3. After submission completes (success or error):
   - Button is re-enabled
   - Original button text is restored
   - Loading spinner is removed

## Development

### Building the Plugin

```bash
# Build for production
npm run build
```

The built files will be placed in `plugin/cf7-extended-validation/dist/`

### Project Structure

```
plugin/cf7-extended-validation/
├── cf7-extended-validation.php  # Main plugin file
├── assets/
│   ├── index.js                 # Entry point (imports JS and CSS)
│   └── cf7-extended-validation.css
└── dist/                        # Compiled files (generated)
    ├── cf7-extended-validation.min.js
    └── cf7-extended-validation.min.css
```

## Customization

### Styling the Loading Spinner

The plugin includes default styles, but you can customize them in your theme's CSS:

```css
/* Customize the spinner color */
.submit-loader {
    border-top-color: #your-color;
}

/* Change the button disabled state */
.wpcf7-submit.disabled {
    opacity: 0.8;
    /* Your custom styles */
}
```

### Changing the Processing Text

You can modify the "Processing..." text by editing the plugin file or using JavaScript:

```javascript
document.addEventListener('wpcf7beforesubmit', function(event) {
    const form = document.querySelector(`[data-wpcf7-id="${event.detail.contactFormId}"]`);
    const submitButton = form.querySelector('.wpcf7-submit');
    if (submitButton) {
        submitButton.value = 'Your Custom Text...';
    }
}, true); // Use capture phase to run before plugin
```

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Modern mobile browsers

## Troubleshooting

### Plugin Not Working

1. Ensure Contact Form 7 is installed and activated
2. Check that the plugin files are in the correct directory
3. Clear your browser cache and WordPress cache
4. Check browser console for JavaScript errors

### Loading Spinner Not Appearing

1. Check if your theme's CSS is conflicting
2. Ensure the plugin's CSS file is being loaded (check page source)
3. Try rebuilding the plugin assets

## Changelog

### Version 1.0.0
- Initial release
- Submit button disable/enable functionality
- Loading spinner and text change
- Full Contact Form 7 integration

## License

GPL v2 or later

## Support

For issues, questions, or contributions, please visit the [GitHub repository](https://github.com/Unknownsock/plugin-cf7-extended-validation).

## Credits

Created for enhancing Contact Form 7 user experience.
