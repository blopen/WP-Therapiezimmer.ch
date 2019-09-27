<div class="ct-component ct-component-table uk-background-transparent uk-section<?php echo $this->index === 0 ? ' first-component' : ''; ?>">
    <?php if ($this->isFieldValid('title')) : ?>
        <header class="ct-component-header uk-margin-bottom">
            <div class="<?php echo $this->containerClass; ?>">
                <h2 class="ct-component-title"><?php echo $this->title; ?></h2>
            </div>
        </header>
    <?php endif; ?>
    
    <div class="ct-component-content">
        <div class="<?php echo $this->containerClass; ?>">
            <table class="ct-table">
                <thead class="ct-table-header">
                <tr class="ct-table-header-row">
                    <?php foreach ($this->tableTitles as $title) : ?>
                        <th class="ct-table-title"><?php echo $title; ?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>
                <tbody class="ct-table-body">
                <?php foreach ($this->tableRows as $rows) : ?>
                    <tr class="ct-table-row">
                        <?php $titleIndex = 0; ?>
                        <?php foreach ($rows as $index => $rowEntry) : ?>
                            <td class="ct-table-data" data-mobile-heading="<?php echo $this->tableTitles[$titleIndex]; ?>"><?php echo $rowEntry; ?></td>
                            <?php $titleIndex++; ?>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>