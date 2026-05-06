document.addEventListener('DOMContentLoaded', () => {
    const trigger = document.getElementById('isifu-accessibility-trigger');
    const panel = document.getElementById('isifu-accessibility-panel');
    const closeBtn = document.getElementById('isifu-close-panel');
    const resetBtn = document.getElementById('isifu-reset-btn');
    
    if (!trigger || !panel) return;

    // Toggle Panel
    const togglePanel = () => {
        const isHidden = panel.hasAttribute('hidden');
        if (isHidden) {
            panel.removeAttribute('hidden');
            setTimeout(() => panel.setAttribute('aria-hidden', 'false'), 10);
            trigger.setAttribute('aria-expanded', 'true');
        } else {
            panel.setAttribute('aria-hidden', 'true');
            trigger.setAttribute('aria-expanded', 'false');
            setTimeout(() => panel.setAttribute('hidden', ''), 300);
        }
    };

    trigger.addEventListener('click', togglePanel);
    closeBtn.addEventListener('click', togglePanel);

    // State Management
    const defaultState = {
        activeButtons: [],
        sliders: {
            'content-scaling': 100,
            'font-size': 100,
            'line-height': 100,
            'letter-spacing': 100
        }
    };
    
    let state = JSON.parse(JSON.stringify(defaultState));

    const loadState = () => {
        const saved = localStorage.getItem('isifu_acc_state_v2');
        if (saved) {
            try {
                Object.assign(state, JSON.parse(saved));
            } catch(e) {}
        }
    };

    const saveState = () => {
        localStorage.setItem('isifu_acc_state_v2', JSON.stringify(state));
    };

    // Apply State to DOM
    const targetStyle = document.createElement('style');
    targetStyle.id = 'isifu-accessibility-dynamic-styles';
    document.head.appendChild(targetStyle);

    const applyState = () => {
        // Handle Grid Buttons CSS classes
        document.querySelectorAll('.isifu-grid-btn').forEach(btn => {
            const action = btn.getAttribute('data-action');
            if (state.activeButtons.includes(action)) {
                btn.classList.add('is-active');
                document.body.classList.add('isifu-' + action);
            } else {
                btn.classList.remove('is-active');
                document.body.classList.remove('isifu-' + action);
            }
        });

        // Compute dynamic CSS
        const scaling = state.sliders['content-scaling'] / 100;
        const fontPct = state.sliders['font-size'];
        const linePct = state.sliders['line-height'];
        
        // letter spacing mapping
        let letterSpacingVal = ((state.sliders['letter-spacing'] - 100) / 1000).toFixed(3);
        if (state.sliders['letter-spacing'] === 100) {
            letterSpacingVal = 'normal';
        } else {
            letterSpacingVal += 'em';
        }

        let dynamicCSS = ``;

        // 1. Font Size
        if (fontPct !== 100) {
            document.documentElement.style.fontSize = fontPct + '%';
        } else {
            document.documentElement.style.fontSize = '';
        }

        // 2. Zoom / Content Scale
        if (scaling !== 1) {
            dynamicCSS += `body { zoom: ${scaling}; } `;
        }
        
        // 3. Line Height
        if (linePct !== 100) {
            dynamicCSS += `body, body * { line-height: ${linePct}% !important; } `;
        }
        
        // 4. Letter Spacing
        if (state.sliders['letter-spacing'] !== 100) {
            dynamicCSS += `body, body * { letter-spacing: ${letterSpacingVal} !important; } `;
        }

        targetStyle.innerHTML = dynamicCSS;

        // Update Slider UI
        Object.keys(state.sliders).forEach(key => {
            const val = state.sliders[key];
            const input = document.getElementById('isifu-slider-' + key);
            const disp = document.getElementById('isifu-val-' + key);
            if (input) input.value = val;
            if (disp) disp.textContent = val;
        });
    };

    const handleButtonClick = (action) => {
        // Mutually exclusive groups
        const colorModes = ['invert-colors', 'monochrome', 'dark-contrast', 'light-contrast'];
        const saturationModes = ['low-saturation', 'high-saturation'];

        let isActive = state.activeButtons.includes(action);

        if (isActive) {
            // Remove it
            state.activeButtons = state.activeButtons.filter(a => a !== action);
        } else {
            // Add it, but check exclusions
            if (colorModes.includes(action)) {
                state.activeButtons = state.activeButtons.filter(a => !colorModes.includes(a));
            }
            if (saturationModes.includes(action)) {
                state.activeButtons = state.activeButtons.filter(a => !saturationModes.includes(a));
            }
            state.activeButtons.push(action);
        }

        applyState();
        saveState();
    };

    document.querySelectorAll('.isifu-grid-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const action = btn.getAttribute('data-action');
            handleButtonClick(action);
        });
    });

    const updateSlider = (id, value) => {
        const input = document.getElementById('isifu-slider-' + id);
        if (!input) return;
        const min = parseInt(input.min);
        const max = parseInt(input.max);
        
        let newVal = parseInt(value);
        if (newVal < min) newVal = min;
        if (newVal > max) newVal = max;

        state.sliders[id] = newVal;
        applyState();
        saveState();
    };

    document.querySelectorAll('input[type="range"]').forEach(input => {
        input.addEventListener('input', (e) => {
            const id = e.target.id.replace('isifu-slider-', '');
            updateSlider(id, e.target.value);
        });
    });

    document.querySelectorAll('.isifu-slider-dec').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-target');
            const input = document.getElementById('isifu-slider-' + id);
            if (input) updateSlider(id, parseInt(state.sliders[id]) - parseInt(input.step));
        });
    });

    document.querySelectorAll('.isifu-slider-inc').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-target');
            const input = document.getElementById('isifu-slider-' + id);
            if (input) updateSlider(id, parseInt(state.sliders[id]) + parseInt(input.step));
        });
    });

    if (resetBtn) {
        resetBtn.addEventListener('click', () => {
            state = JSON.parse(JSON.stringify(defaultState));
            applyState();
            saveState();
        });
    }

    // Init
    loadState();
    applyState();
});
