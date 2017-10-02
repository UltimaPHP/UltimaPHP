namespace UltimaPHPExport
{
    partial class UltimaPHPExportForm
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.groupBox1 = new System.Windows.Forms.GroupBox();
            this.label2 = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.numY = new System.Windows.Forms.NumericUpDown();
            this.numX = new System.Windows.Forms.NumericUpDown();
            this.flowLayoutPanel1 = new System.Windows.Forms.FlowLayoutPanel();
            this.chkNoMove = new System.Windows.Forms.CheckBox();
            this.chkNoDispose = new System.Windows.Forms.CheckBox();
            this.chkNoClose = new System.Windows.Forms.CheckBox();
            this.btn_Export = new System.Windows.Forms.Button();
            this.btn_Cancel = new System.Windows.Forms.Button();
            this.groupBox2 = new System.Windows.Forms.GroupBox();
            this.txt_GumpName = new System.Windows.Forms.TextBox();
            this.groupBox1.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.numY)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.numX)).BeginInit();
            this.flowLayoutPanel1.SuspendLayout();
            this.groupBox2.SuspendLayout();
            this.SuspendLayout();
            // 
            // groupBox1
            // 
            this.groupBox1.Controls.Add(this.label2);
            this.groupBox1.Controls.Add(this.label1);
            this.groupBox1.Controls.Add(this.numY);
            this.groupBox1.Controls.Add(this.numX);
            this.groupBox1.Controls.Add(this.flowLayoutPanel1);
            this.groupBox1.Location = new System.Drawing.Point(12, 12);
            this.groupBox1.Name = "groupBox1";
            this.groupBox1.Size = new System.Drawing.Size(381, 76);
            this.groupBox1.TabIndex = 0;
            this.groupBox1.TabStop = false;
            this.groupBox1.Text = "Gump Options";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(134, 44);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(14, 13);
            this.label2.TabIndex = 4;
            this.label2.Text = "Y";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(133, 19);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(14, 13);
            this.label1.TabIndex = 3;
            this.label1.Text = "X";
            // 
            // numY
            // 
            this.numY.Location = new System.Drawing.Point(7, 40);
            this.numY.Name = "numY";
            this.numY.Size = new System.Drawing.Size(120, 20);
            this.numY.TabIndex = 2;
            this.numY.Value = new decimal(new int[] {
            50,
            0,
            0,
            0});
            // 
            // numX
            // 
            this.numX.Location = new System.Drawing.Point(7, 17);
            this.numX.Name = "numX";
            this.numX.Size = new System.Drawing.Size(120, 20);
            this.numX.TabIndex = 1;
            this.numX.Value = new decimal(new int[] {
            50,
            0,
            0,
            0});
            // 
            // flowLayoutPanel1
            // 
            this.flowLayoutPanel1.Controls.Add(this.chkNoMove);
            this.flowLayoutPanel1.Controls.Add(this.chkNoDispose);
            this.flowLayoutPanel1.Controls.Add(this.chkNoClose);
            this.flowLayoutPanel1.Location = new System.Drawing.Point(185, 14);
            this.flowLayoutPanel1.Name = "flowLayoutPanel1";
            this.flowLayoutPanel1.Size = new System.Drawing.Size(190, 47);
            this.flowLayoutPanel1.TabIndex = 0;
            // 
            // chkNoMove
            // 
            this.chkNoMove.AutoSize = true;
            this.chkNoMove.Location = new System.Drawing.Point(3, 3);
            this.chkNoMove.Name = "chkNoMove";
            this.chkNoMove.Size = new System.Drawing.Size(70, 17);
            this.chkNoMove.TabIndex = 0;
            this.chkNoMove.Text = "No Move";
            this.chkNoMove.UseVisualStyleBackColor = true;
            // 
            // chkNoDispose
            // 
            this.chkNoDispose.AutoSize = true;
            this.chkNoDispose.Location = new System.Drawing.Point(79, 3);
            this.chkNoDispose.Name = "chkNoDispose";
            this.chkNoDispose.Size = new System.Drawing.Size(81, 17);
            this.chkNoDispose.TabIndex = 1;
            this.chkNoDispose.Text = "No Dispose";
            this.chkNoDispose.UseVisualStyleBackColor = true;
            // 
            // chkNoClose
            // 
            this.chkNoClose.AutoSize = true;
            this.chkNoClose.Location = new System.Drawing.Point(3, 26);
            this.chkNoClose.Name = "chkNoClose";
            this.chkNoClose.Size = new System.Drawing.Size(69, 17);
            this.chkNoClose.TabIndex = 2;
            this.chkNoClose.Text = "No Close";
            this.chkNoClose.UseVisualStyleBackColor = true;
            // 
            // btn_Export
            // 
            this.btn_Export.Location = new System.Drawing.Point(318, 147);
            this.btn_Export.Name = "btn_Export";
            this.btn_Export.Size = new System.Drawing.Size(75, 23);
            this.btn_Export.TabIndex = 2;
            this.btn_Export.Text = "Ok";
            this.btn_Export.UseVisualStyleBackColor = true;
            this.btn_Export.Click += new System.EventHandler(this.btn_Export_Click);
            // 
            // btn_Cancel
            // 
            this.btn_Cancel.Location = new System.Drawing.Point(237, 147);
            this.btn_Cancel.Name = "btn_Cancel";
            this.btn_Cancel.Size = new System.Drawing.Size(75, 23);
            this.btn_Cancel.TabIndex = 3;
            this.btn_Cancel.Text = "Cancel";
            this.btn_Cancel.UseVisualStyleBackColor = true;
            this.btn_Cancel.Click += new System.EventHandler(this.btn_Cancel_Click);
            // 
            // groupBox2
            // 
            this.groupBox2.Controls.Add(this.txt_GumpName);
            this.groupBox2.Location = new System.Drawing.Point(12, 94);
            this.groupBox2.Name = "groupBox2";
            this.groupBox2.Size = new System.Drawing.Size(381, 47);
            this.groupBox2.TabIndex = 4;
            this.groupBox2.TabStop = false;
            this.groupBox2.Text = "Gump Name";
            // 
            // txt_GumpName
            // 
            this.txt_GumpName.Location = new System.Drawing.Point(7, 20);
            this.txt_GumpName.Name = "txt_GumpName";
            this.txt_GumpName.Size = new System.Drawing.Size(368, 20);
            this.txt_GumpName.TabIndex = 0;
            // 
            // UltimaPHPExportForm
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(405, 182);
            this.Controls.Add(this.groupBox2);
            this.Controls.Add(this.btn_Cancel);
            this.Controls.Add(this.btn_Export);
            this.Controls.Add(this.groupBox1);
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "UltimaPHPExportForm";
            this.Text = "UltimaPHP Export Plugin";
            this.groupBox1.ResumeLayout(false);
            this.groupBox1.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.numY)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.numX)).EndInit();
            this.flowLayoutPanel1.ResumeLayout(false);
            this.flowLayoutPanel1.PerformLayout();
            this.groupBox2.ResumeLayout(false);
            this.groupBox2.PerformLayout();
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.GroupBox groupBox1;
        private System.Windows.Forms.FlowLayoutPanel flowLayoutPanel1;
        private System.Windows.Forms.CheckBox chkNoMove;
        private System.Windows.Forms.CheckBox chkNoDispose;
        private System.Windows.Forms.CheckBox chkNoClose;
        private System.Windows.Forms.Button btn_Export;
        private System.Windows.Forms.Button btn_Cancel;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.NumericUpDown numY;
        private System.Windows.Forms.NumericUpDown numX;
        private System.Windows.Forms.GroupBox groupBox2;
        private System.Windows.Forms.TextBox txt_GumpName;
    }
}