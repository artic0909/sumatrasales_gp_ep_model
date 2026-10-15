<!-- Solutions Marquee Controller Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('solutions-marquee-container');
            const track = document.getElementById('solutions-marquee-track');
            if (!container || !track) return;

            let isPaused = false;
            let offset = 0;
            const speed = 0.9; // Smooth, steady, premium flow
            let lastTime = performance.now();

            // Hover pause
            container.addEventListener('mouseenter', () => { isPaused = true; });
            container.addEventListener('mouseleave', () => { isPaused = false; });
            // Touch pause for mobile
            let touchTimer = null;
            container.addEventListener('touchstart', () => { 
                isPaused = true; 
                clearTimeout(touchTimer);
            }, { passive: true });
            container.addEventListener('touchend', () => { 
                touchTimer = setTimeout(() => { isPaused = false; }, 1200); 
            }, { passive: true });

            function getHalfWidth() {
                return track.scrollWidth / 2;
            }
            let halfWidth = getHalfWidth();
            window.addEventListener('resize', () => {
                halfWidth = getHalfWidth();
            });

            function tick(currentTime) {
                const delta = Math.min(currentTime - lastTime, 40);
                lastTime = currentTime;

                if (!isPaused && halfWidth > 0) {
                    offset += speed * (delta / 16.667);
                    if (offset >= halfWidth) {
                        offset -= halfWidth;
                    }
                    track.style.transform = 'translate3d(-' + offset.toFixed(2) + 'px, 0, 0)';
                }

                requestAnimationFrame(tick);
            }

            requestAnimationFrame(tick);
        });

        // ==========================================
        // BROAD MEGA DROPDOWNS INTERACTION CONTROLLER
        // ==========================================
        document.addEventListener('DOMContentLoaded', () => {
            const subHeader = document.getElementById('sub-header-bar');
            if (!subHeader) return;

            const triggers = subHeader.querySelectorAll('.nav-dropdown-trigger');
            const panels = subHeader.querySelectorAll('.broad-dropdown-panel');
            const dropdownsContainer = document.getElementById('broad-dropdowns-container');

            let activeTrigger = null;
            let activePanel = null;
            let closeTimer = null;

            function openDropdown(trigger) {
                if (closeTimer) {
                    clearTimeout(closeTimer);
                    closeTimer = null;
                }

                const targetId = trigger.getAttribute('data-dropdown-trigger');
                const targetPanel = document.getElementById(targetId);
                if (!targetPanel) return;

                // Deactivate current trigger if different
                if (activeTrigger && activeTrigger !== trigger) {
                    activeTrigger.removeAttribute('data-active');
                    const prevChevron = activeTrigger.querySelector('.dropdown-chevron');
                    if (prevChevron) prevChevron.classList.remove('rotate-180');
                }

                // Immediately hide and collapse other panels so only targetPanel is rendered
                panels.forEach(p => {
                    if (p !== targetPanel) {
                        p.classList.add('hidden', 'opacity-0', '-translate-y-2', 'pointer-events-none');
                        p.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
                    }
                });

                activeTrigger = trigger;
                activePanel = targetPanel;

                // Highlight active trigger and flip chevron
                trigger.setAttribute('data-active', 'true');
                const chevron = trigger.querySelector('.dropdown-chevron');
                if (chevron) chevron.classList.add('rotate-180');

                // Enable container
                if (dropdownsContainer) {
                    dropdownsContainer.classList.remove('pointer-events-none');
                }

                // Unhide target panel and animate in
                targetPanel.classList.remove('hidden');
                void targetPanel.offsetHeight; // Force reflow for smooth transition
                targetPanel.classList.remove('opacity-0', '-translate-y-2', 'pointer-events-none');
                targetPanel.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');
            }

            function closePanel(panel, trigger, instant = false) {
                if (trigger) {
                    trigger.removeAttribute('data-active');
                    const chevron = trigger.querySelector('.dropdown-chevron');
                    if (chevron) chevron.classList.remove('rotate-180');
                }

                if (panel) {
                    panel.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
                    panel.classList.add('opacity-0', '-translate-y-2', 'pointer-events-none');
                    if (instant) {
                        panel.classList.add('hidden');
                    } else {
                        setTimeout(() => {
                            if (panel !== activePanel) {
                                panel.classList.add('hidden');
                            }
                        }, 200);
                    }
                }

                if (!instant) {
                    activeTrigger = null;
                    activePanel = null;
                    if (dropdownsContainer) {
                        dropdownsContainer.classList.add('pointer-events-none');
                    }
                }
            }

            function scheduleClose() {
                if (closeTimer) clearTimeout(closeTimer);
                closeTimer = setTimeout(() => {
                    if (activePanel) {
                        closePanel(activePanel, activeTrigger);
                    }
                }, 220);
            }

            function cancelClose() {
                if (closeTimer) {
                    clearTimeout(closeTimer);
                    closeTimer = null;
                }
            }

            // Triggers hover and click
            triggers.forEach(trigger => {
                trigger.addEventListener('mouseenter', () => {
                    openDropdown(trigger);
                });

                trigger.addEventListener('mouseleave', () => {
                    scheduleClose();
                });

                trigger.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (activeTrigger === trigger) {
                        closePanel(activePanel, activeTrigger);
                    } else {
                        openDropdown(trigger);
                    }
                });
            });

            // Container and panel hover bridges
            if (dropdownsContainer) {
                dropdownsContainer.addEventListener('mouseenter', () => {
                    cancelClose();
                });

                dropdownsContainer.addEventListener('mouseleave', () => {
                    scheduleClose();
                });
            }

            panels.forEach(panel => {
                panel.addEventListener('mouseenter', () => {
                    cancelClose();
                });

                panel.addEventListener('mouseleave', () => {
                    scheduleClose();
                });
            });

            // Click outside
            document.addEventListener('click', (e) => {
                if (!subHeader.contains(e.target)) {
                    if (activePanel) closePanel(activePanel, activeTrigger);
                }
            });

            // Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && activePanel) {
                    closePanel(activePanel, activeTrigger);
                }
            });

            // Close when clicking an anchor link inside panels
            panels.forEach(panel => {
                const links = panel.querySelectorAll('a');
                links.forEach(link => {
                    link.addEventListener('click', () => {
                        closePanel(panel, activeTrigger, true);
                    });
                });
            });

            // ==========================================
            // MOBILE NAVIGATION DRAWER & ACCORDION CONTROLLER
            // ==========================================
            const mobileToggle = document.getElementById('mobile-menu-toggle');
            const mobileClose = document.getElementById('mobile-menu-close');
            const mobileBackdrop = document.getElementById('mobile-menu-backdrop');
            const mobileDrawer = document.getElementById('mobile-menu-drawer');

            function openMobileMenu() {
                if (!mobileDrawer || !mobileBackdrop) return;
                mobileBackdrop.classList.remove('hidden');
                void mobileBackdrop.offsetHeight;
                mobileBackdrop.classList.remove('opacity-0');
                mobileBackdrop.classList.add('opacity-100');

                mobileDrawer.classList.remove('translate-x-full');
                mobileDrawer.classList.add('translate-x-0');
                document.body.classList.add('overflow-hidden');
            }

            function closeMobileMenu() {
                if (!mobileDrawer || !mobileBackdrop) return;
                mobileDrawer.classList.remove('translate-x-0');
                mobileDrawer.classList.add('translate-x-full');

                mobileBackdrop.classList.remove('opacity-100');
                mobileBackdrop.classList.add('opacity-0');

                setTimeout(() => {
                    mobileBackdrop.classList.add('hidden');
                }, 300);

                document.body.classList.remove('overflow-hidden');
            }

            if (mobileToggle) {
                mobileToggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    openMobileMenu();
                });
            }

            if (mobileClose) {
                mobileClose.addEventListener('click', (e) => {
                    e.preventDefault();
                    closeMobileMenu();
                });
            }

            if (mobileBackdrop) {
                mobileBackdrop.addEventListener('click', () => {
                    closeMobileMenu();
                });
            }

            // Close on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && mobileDrawer && !mobileDrawer.classList.contains('translate-x-full')) {
                    closeMobileMenu();
                }
            });

            // Close mobile menu when clicking internal page anchor links
            const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
            mobileNavLinks.forEach(link => {
                link.addEventListener('click', () => {
                    const href = link.getAttribute('href');
                    if (href && (href.startsWith('#') || href.includes('#'))) {
                        closeMobileMenu();
                    }
                });
            });

            // Accordion toggle behavior
            const accordionTriggers = document.querySelectorAll('.mobile-accordion-trigger');
            accordionTriggers.forEach(btn => {
                btn.addEventListener('click', () => {
                    const panel = btn.nextElementSibling;
                    const chevron = btn.querySelector('.mobile-chevron');
                    if (!panel) return;

                    const isExpanded = !panel.classList.contains('hidden');

                    // Close all other accordion panels for clean UX
                    accordionTriggers.forEach(otherBtn => {
                        if (otherBtn !== btn) {
                            const otherPanel = otherBtn.nextElementSibling;
                            const otherChevron = otherBtn.querySelector('.mobile-chevron');
                            if (otherPanel) otherPanel.classList.add('hidden');
                            if (otherChevron) otherChevron.classList.remove('rotate-180');
                        }
                    });

                    if (isExpanded) {
                        panel.classList.add('hidden');
                        if (chevron) chevron.classList.remove('rotate-180');
                    } else {
                        panel.classList.remove('hidden');
                        if (chevron) chevron.classList.add('rotate-180');
                    }
                });
            });
        });
    </script>
