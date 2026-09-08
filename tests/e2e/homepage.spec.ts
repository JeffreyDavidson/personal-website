import AxeBuilder from '@axe-core/playwright';
import { expect, test } from '@playwright/test';

for (const width of [390, 768, 1280]) {
    for (const colorScheme of ['light', 'dark'] as const) {
        test(`homepage at ${width}px in ${colorScheme} mode`, async ({ page }, testInfo) => {
            await page.setViewportSize({ width, height: 900 });
            await page.emulateMedia({ colorScheme, reducedMotion: 'reduce' });
            await page.goto('/');

            await expect(page.getByRole('heading', { name: 'Away from the editor' })).toBeVisible();
            const dimensions = await page.evaluate(() => ({
                viewport: document.documentElement.clientWidth,
                content: document.documentElement.scrollWidth,
            }));
            expect(dimensions.content).toBeLessThanOrEqual(dimensions.viewport);

            const results = await new AxeBuilder({ page }).include('main').analyze();
            expect(results.violations.filter(({ impact }) => impact === 'serious' || impact === 'critical')).toEqual([]);

            await page.locator('.media-section').screenshot({ path: testInfo.outputPath('homepage-media.png') });
            await page.locator('[data-home-services]').screenshot({ path: testInfo.outputPath('homepage-services.png'), style: 'header { visibility: hidden !important; }' });
            await page.locator('[data-home-work]').screenshot({ path: testInfo.outputPath('homepage-work.png'), style: 'header { visibility: hidden !important; }' });
        });
    }
}
